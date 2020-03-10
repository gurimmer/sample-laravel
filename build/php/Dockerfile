FROM php:7.2-fpm-alpine3.9

COPY build/php/php.ini /usr/local/etc/php/conf.d/
COPY build/php/www.conf /usr/local/etc/php-fpm.d/
COPY src /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache icu-dev libjpeg-turbo-dev libpng-dev zlib-dev \
  && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
  && docker-php-ext-install gd intl opcache pdo_mysql zip \
  && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
USER www-data

RUN composer global require hirak/prestissimo \
  && composer clear-cache
