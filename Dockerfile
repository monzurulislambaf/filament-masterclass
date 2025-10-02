# Stage 1: Build dependencies with Composer
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Stage 2: Laravel with PHP-FPM
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
  bash \
  curl \
  git \
  icu-dev \
  libpng-dev \
  libxml2-dev \
  oniguruma-dev \
  zip \
  unzip \
  mariadb-client \
  && docker-php-ext-install pdo pdo_mysql intl gd bcmath

# Set working directory
WORKDIR /var/www/html

# Copy vendor from builder
COPY --from=vendor /app/vendor ./vendor

# Copy Laravel app
COPY . .

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache

# Expose PHP-FPM port (CapRover will proxy to this)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
