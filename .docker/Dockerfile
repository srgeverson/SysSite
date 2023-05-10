FROM php:7.4-apache
RUN apt-get update && apt-get upgrade -y
# MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli
# PostgreSQL
# RUN docker-php-ext-install pdo pdo_pgsql pgsql