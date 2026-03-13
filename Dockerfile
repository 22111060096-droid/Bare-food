FROM php:8.2-apache

WORKDIR /var/www/html

# cài package cần thiết
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip

# cài extension php
RUN docker-php-ext-install pdo pdo_mysql

# cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy source code
COPY . .

# bật apache rewrite
RUN a2enmod rewrite

# trỏ apache vào thư mục public của laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# cài thư viện laravel
RUN composer install --no-dev --optimize-autoloader

# cấp quyền
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80