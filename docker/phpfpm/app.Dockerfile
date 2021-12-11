FROM php:7.4-fpm-alpine

RUN apk add git curl openssl libzip-dev freetype-dev php7-pecl-apcu
RUN docker-php-ext-install zip pdo_mysql

WORKDIR /var/www

# Copy source code
COPY --chown=www-data:www-data ./src /var/www

# Composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer install

# Setup env
RUN cp .env.example .env

RUN php artisan key:generate
RUN chmod -R 777 ./storage
