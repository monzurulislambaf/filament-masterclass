# Stage 1: Build PHP dependencies
FROM composer:2 AS build
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Production container
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Nginx & Supervisor
RUN apt-get install -y nginx supervisor

# Copy app code
WORKDIR /var/www/html
COPY . .
COPY --from=build /app/vendor ./vendor

# Copy default nginx config
RUN rm -rf /etc/nginx/sites-enabled/*
COPY ./deploy/nginx.conf /etc/nginx/sites-enabled/default

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Start services
CMD service php8.2-fpm start && nginx -g "daemon off;"
