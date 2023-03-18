# Dockerfile
FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

#To get the source files inside the container, we can use the COPY command again:
COPY . /var/www/html

#Allow access for user server application
RUN chown -R www-data:www-data /var/www/html

#We’ll call the start script we created earlier:
CMD ["start-apache"]