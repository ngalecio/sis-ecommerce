# =========================
# ETAPA 1: Build Vite
# =========================
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# =========================
# ETAPA 2: Composer
# =========================
FROM php:8.3-fpm-alpine AS php-builder
WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

COPY . .
RUN composer dump-autoload --optimize

# =========================
# ETAPA 3: Producción
# =========================
FROM php:8.3-fpm-alpine

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

# Copiar código
COPY --from=php-builder /var/www/html /var/www/html
COPY --from=node-builder /app/public/build ./public/build

# Configs
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Directorios Laravel
RUN mkdir -p storage/framework/{sessions,views,cache} \
    storage/logs \
    storage/app/public \
    bootstrap/cache \
    public/storage \
    && ln -sf /var/www/html/storage/app/public /var/www/html/public/storage \
    && touch storage/logs/laravel.log

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache public/storage \
    && chmod -R 775 storage bootstrap/cache public/storage \
    && chmod 664 storage/logs/laravel.log

# EntryPoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=40s \
    CMD wget --quiet --tries=1 --spider http://localhost/up || exit 1

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
