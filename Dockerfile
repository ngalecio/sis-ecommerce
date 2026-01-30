# FROM php:8.3.7-fpm-alpine

# # Instala dependencias del sistema y extensiones necesarias
# RUN apk --no-cache upgrade && \
#     apk add --no-cache linux-headers bash git sudo openssh libxml2-dev oniguruma-dev autoconf gcc g++ make npm freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev icu-dev \
#     && pecl channel-update pecl.php.net \
#     && pecl install pcov swoole \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-configure intl \
#     && docker-php-ext-install mbstring xml pcntl gd zip sockets pdo_mysql bcmath soap intl \
#     && docker-php-ext-enable mbstring xml gd zip pcov pcntl sockets bcmath pdo_mysql soap swoole intl

# # Instala Composer (solo una vez)
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # (Opcional) Instala RoadRunner si lo necesitas
# # COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

# WORKDIR /app
# COPY . .

# # Instala dependencias de Composer y limpia caché
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
#     && composer clear-cache

# # Instala Octane y Swoole (ajusta si solo usas uno)
# RUN composer require laravel/octane spiral/roadrunner --no-interaction --no-scripts || true

# # Copia el archivo de entorno (ajusta según tu flujo)
# COPY .envDev .env

# # Asegura permisos correctos
# RUN mkdir -p /app/storage/logs /app/bootstrap/cache \
#     && chown -R www-data:www-data /app/storage /app/bootstrap/cache

#  # Instala Octane (solo Swoole en este ejemplo)
# RUN php artisan octane:install --server="swoole"

# # Crea el link simbólico de storage
# RUN php artisan storage:link

# EXPOSE 8000
# CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0"]

# ETAPA 1: Compilar Assets (Vite)
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci --only=production
COPY . .
RUN npm run build

# ETAPA 2: Instalar Dependencias PHP
FROM php:8.3-fpm-alpine AS php-builder
WORKDIR /var/www/html

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos de dependencias primero (cache layer)
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

# Copiar configuraciones de nginx, supervisor y php-fpm
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Crear estructura de directorios necesaria
RUN mkdir -p storage/framework/{sessions,views,cache,testing} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public \
    && mkdir -p bootstrap/cache \
    && mkdir -p public/storage \
    && touch storage/logs/laravel.log

# Crear symlink de storage (equivalente a php artisan storage:link)
RUN ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/public/storage \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/public/storage \
    && chmod 664 /var/www/html/storage/logs/laravel.log

# Limpiar cache de Laravel (puede fallar si no hay .env, por eso el || true)
RUN php artisan config:clear 2>/dev/null || true \
    && php artisan route:clear 2>/dev/null || true \
    && php artisan view:clear 2>/dev/null || true \
    && php artisan cache:clear 2>/dev/null || true

EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=40s \
    CMD wget --quiet --tries=1 --spider http://localhost/up || exit 1

# Iniciar supervisor (controla nginx y php-fpm)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]