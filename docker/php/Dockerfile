##----------------------------
FROM composer:2.5 as composer_build
WORKDIR /app
COPY . /app
RUN composer install --optimize-autoloader --ignore-platform-reqs --no-interaction --no-plugins --prefer-dist
#--no-dev (dev tiene que ir para testing ¯\_(ツ)_/¯)

##----------------------------
FROM php:8.2-fpm


##configuracion del certificado del antivirus
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/Fortinet_CA_SSL.cer    /etc/ssl/certs
COPY docker/php/ca-certificates.crt /etc/ssl/certs
RUN update-ca-certificates --fresh
###
RUN apt-get update  --allow-releaseinfo-change-suite  && apt-get install acl apt-utils nano -y

###############
WORKDIR /var/www

##composer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
#instalar paquetes de php
RUN install-php-extensions pdo_pgsql opcache
COPY . /var/www
RUN cp .env.example .env && chown www-data:www-data storage -R && chown www-data:www-data bootstrap/cache -R
#traer lo construido en la etapa composer
COPY --from=composer_build /app/vendor /var/www/vendor
RUN php artisan cache:clear

