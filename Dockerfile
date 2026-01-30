# ETAPA 1: Compilar Assets (Vite)
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ETAPA 2: Instalar Dependencias PHP
FROM php:8.3-fpm-alpine AS php-builder
WORKDIR /var/www/html

# Copiar archivos de composer primero (mejor cache)
COPY composer.json composer.lock ./
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copiar el resto del código
COPY . .

# Ejecutar scripts post-install
RUN composer dump-autoload --optimize

# ETAPA 3: Imagen Final de Producción
FROM php:8.3-fpm-alpine

# Instalar dependencias del sistema y extensiones PHP
RUN apk add --no-cache \
    nginx \
    supervisor \
    libzip-dev \
    libpng-dev \
    icu-dev \
    wget \
    && docker-php-ext-install pdo_mysql zip gd intl

WORKDIR /var/www/html

# Copiar código desde builder
COPY --from=php-builder /var/www/html /var/www/html
COPY --from=node-builder /app/public/build ./public/build

# ⚠️ Configuración de Nginx, Supervisor Y PHP-FPM (ANTES de crear directorios)
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Crear directorios necesarios
RUN mkdir -p storage/framework/{sessions,views,cache,testing} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && touch storage/logs/laravel.log

# ⚠️ IMPORTANTE: Dar ownership a www-data
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Limpiar cache
RUN php artisan config:clear 2>/dev/null || true \
    && php artisan route:clear 2>/dev/null || true \
    && php artisan view:clear 2>/dev/null || true \
    && php artisan cache:clear 2>/dev/null || true

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=40s \
    CMD wget --quiet --tries=1 --spider http://localhost/up || exit 1

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]