FROM php:8.2-apache

ARG COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        libicu-dev \
        unzip \
        zip \
    && docker-php-ext-install intl mysqli pdo_mysql \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY . .
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar writable/database \
    && chown -R www-data:www-data writable \
    && chmod -R 775 writable

EXPOSE 80
