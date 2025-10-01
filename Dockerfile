# -------- Base Image --------
FROM php:8.2-apache

WORKDIR /var/www/html

# -------- System dependencies --------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    curl \
    zip \
    npm \
    nodejs \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd \
    && a2enmod rewrite

# -------- Install Composer --------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# -------- Copy project files --------
COPY . /var/www/html

# -------- Permissions --------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# -------- Install PHP dependencies --------
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-intl --ignore-platform-req=ext-gd

# -------- Build frontend assets --------
RUN npm install
RUN npm run build

# -------- Laravel setup --------
RUN php artisan key:generate --ansi \
    && php artisan migrate --force --graceful \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80

CMD ["apache2-foreground"]
