FROM php:8.2-apache

WORKDIR /var/www/html

# cài package cần thiết
RUN apt-get update && apt-get install -y \
    zip unzip git curl

# cài extension php
RUN docker-php-ext-install pdo pdo_mysql

# cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy project
COPY . .

# bật apache rewrite
RUN a2enmod rewrite

# trỏ apache vào thư mục public của Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# cài thư viện Laravel
RUN composer install

# cấp quyền cho Laravel
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

EXPOSE 80