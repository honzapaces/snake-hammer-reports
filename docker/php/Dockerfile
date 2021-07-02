FROM php:8-fpm-alpine

WORKDIR /code

RUN mkdir -p /code/temp \
	&& mkdir -p /code/log \
	&& mkdir -p /sock

RUN chmod 0777 /sock

RUN apk add --no-cache \
    zlib \
    libpq \
    mysql-dev \
    zlib-dev \
    libzip-dev \
    unzip \
    freetype-dev \
    libjpeg-turbo-dev \
    libmcrypt \
    libpng-dev \
    icu-dev \
    openssl \
    fcgi

RUN docker-php-ext-install pdo pdo_mysql mysqli sockets zip opcache \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl bcmath

ADD zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
