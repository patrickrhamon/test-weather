FROM php:8.1.0-fpm-alpine3.15

USER root

#ini rename
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN set -e; \
    apk add --no-cache \
    coreutils \
    freetype-dev \
    libjpeg-turbo-dev \
    libjpeg-turbo \
    libpng-dev \
    libzip-dev \
    jpeg-dev \
    icu-dev \
    zlib-dev \
    curl-dev \
    imap-dev \
    libxslt-dev libxml2-dev \
    postgresql-dev \
    libgcrypt-dev \
    oniguruma-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure imap
RUN docker-php-ext-install calendar

RUN set -e; docker-php-ext-install -j "$(nproc)" \
    gd soap imap bcmath mbstring iconv curl sockets \
    pdo_pgsql \
    xsl \
    exif \
    mysqli pdo pdo_mysql \
    intl \
    zip

RUN apk add --no-cache libmcrypt-dev libmcrypt

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN apk add openrc

RUN apk add nano
RUN export EDITOR=/usr/bin/nano

RUN apk add nginx && \
    mkdir -p /etc/nginx/sites-enabled /run/nginx && \
    ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

RUN apk add --no-cache --upgrade bash

RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf

# install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

#install opcache
RUN docker-php-ext-install opcache
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name opcache.so)" > /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.memory_consumption=192" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_wasted_percentage=10" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

#acertar fuso
RUN apk add tzdata && cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime

#inserir linha do cron
RUN mkdir /var/log/cron
RUN echo '* * * * * cd /var/www/html && /usr/local/bin/php artisan schedule:run > /var/log/cron/laravel.log 2>&1' > /etc/crontabs/root

#start crontab
RUN crontab -l

#run crontab
CMD ["sh", "-c", "crond && php-fpm && nginx -g 'daemon off;'"]