FROM php:7.4-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql mysqli

VOLUME /var/www/html

COPY . /var/www/html

EXPOSE 80