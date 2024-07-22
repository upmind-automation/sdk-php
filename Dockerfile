FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    libicu-dev \
    libxml2-dev \
    uuid-dev \
    libsodium-dev

RUN docker-php-ext-install zip intl soap sodium

RUN pecl install xdebug-3.3.2 \
    && pecl install uuid \
    && docker-php-ext-enable xdebug uuid

COPY docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN mkdir -p /var/log/php/ \
    && touch /var/log/php/xdebug.log \
    && chmod 777 /var/log/php/xdebug.log

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /upmind-sdk-php

COPY docker/start.sh docker/start.sh

RUN chmod +x docker/start.sh

VOLUME ["/upmind-sdk-php"]

EXPOSE 80/tcp
EXPOSE 9000

CMD ["docker/start.sh"]