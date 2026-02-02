# ETAPA 1: Compilar Assets (Vite)
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ETAPA 2: Instalar Dependencias PHP
FROM php:8.3-fpm-alpine AS php-builder
WORKDIR /var/www/html

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos de dependencias
COPY composer.json composer.lock ./

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copiar el resto del código
COPY . .

# Dump autoload optimizado
RUN composer dump-autoload --optimize

# ETAPA 3: Imagen Final de Producción
FROM php:8.3-fpm-alpine

# Instalar dependencias del sistema y extensiones PHP
RUN apk add --no-cache \
    nginx \
    supervisor \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    oniguruma-dev \
    wget \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd intl mbstring bcmath

WORKDIR /var/www/html

# Copiar código desde builders
COPY --from=php-builder /var/www/html /var/www/html
COPY --from=node-builder /app/public/build ./public/build

# Copiar configuraciones
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Crear estructura de directorios
RUN mkdir -p storage/framework/{sessions,views,cache,testing} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public \
    && mkdir -p bootstrap/cache \
    && mkdir -p public/storage \
    && touch storage/logs/laravel.log

# Crear symlink de storage
RUN ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/public/storage \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/public/storage \
    && chmod 664 /var/www/html/storage/logs/laravel.log

# Limpiar cache
RUN php artisan config:clear 2>/dev/null || true \
    && php artisan route:clear 2>/dev/null || true \
    && php artisan view:clear 2>/dev/null || true \
    && php artisan cache:clear 2>/dev/null || true

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=40s \
    CMD wget --quiet --tries=1 --spider http://localhost/up || exit 1

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]