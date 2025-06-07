# Gunakan image PHP FPM
FROM php:8.2-fpm

# Install ekstensi dan dependensi PHP
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy semua file project ke dalam container
COPY . .

# Install dependensi Laravel
RUN composer install --optimize-autoloader --no-dev

# Set permission folder storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
