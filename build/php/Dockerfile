FROM php:8.0.0-fpm-alpine3.12

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY build/php/php.ini /usr/local/etc/php/conf.d/
COPY build/php/www.conf /usr/local/etc/php-fpm.d/
COPY src /var/www/html
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
		libjpeg-turbo-dev \
		libpng-dev \
		libzip-dev \
		zlib-dev \
	&& docker-php-ext-configure gd --with-jpeg=/usr/include/ \
	&& docker-php-ext-configure zip \
	&& docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) pdo pdo_mysql gd mysqli opcache zip \
    && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
USER www-data
