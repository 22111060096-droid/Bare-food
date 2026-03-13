FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip

RUN docker-php-ext-install pdo pdo_mysql

# cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN composer install --no-dev --optimize-autoloader

# 🔥 THÊM DÒNG NÀY
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 80