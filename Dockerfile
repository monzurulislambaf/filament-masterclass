# Use PHP 8.3 CLI as base
FROM php:8.2-fpm

# Install system dependencies + required dev headers for PHP extensions
RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libzip-dev \
  zip \
  unzip \
  supervisor \
  nginx \
  libicu-dev \
  && apt-get clean
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
RUN docker-php-ext-install intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy entire app (including composer.json, etc.)
COPY . .

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Optimize Laravel for production
RUN php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache

# Fix file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx & Supervisor configs
COPY ./deploy/nginx.conf /etc/nginx/sites-available/default
COPY ./deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 80
EXPOSE 80

# Start supervisord (runs PHP-FPM + Nginx)
CMD ["php-fpm"]
