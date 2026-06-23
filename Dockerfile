FROM php:8.2-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY ./web-asat-10-sija-2 /var/www/web
RUN sed -i 's|/var/www/html|/var/www/web|g' /etc/apache2/sites-available/000-default.conf
EXPOSE 80
