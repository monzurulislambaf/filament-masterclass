# -------------------------------
# Stage 1: Composer dependencies
# -------------------------------
  # Stage 1: Composer dependencies
FROM php:8.2-cli AS build

WORKDIR /app

# Copy everything (not just composer.json)
COPY . .

# Install PHP extensions for composer
RUN apt-get update && apt-get install -y \
    libicu-dev libonig-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install intl gd zip mbstring

# Install Composer dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader
FROM composer:2 AS build

WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-intl --ignore-platform-req=ext-gd

# -------------------------------
# Stage 2: PHP-FPM Production
# -------------------------------
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath intl gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy app code
COPY . .

# Copy composer dependencies from build stage
COPY --from=build /app/vendor ./vendor

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
