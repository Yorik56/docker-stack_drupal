# Dockerfile
FROM php:8.0-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80
WORKDIR /app

# git, unzip & zip are for composer
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    libpng-dev \
    gnupg \
    unzip \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP Extensions
RUN docker-php-ext-install gd
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql
COPY php/conf/php.ini /usr/local/etc/php/conf.d/app.ini

# Apache
#COPY errors /errors
COPY php/conf/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php/conf/apache.conf /etc/apache2/conf-available/z-app.conf
COPY . /app
RUN chmod 770 /app/web/sites/default/files/
RUN chmod 660 /app/web/sites/default/settings.php

RUN a2enmod rewrite remoteip && \
    a2enconf z-app \

