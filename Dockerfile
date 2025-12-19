# Base image: PHP + Apache
FROM php:8.2-apache

# Apache rewrite enable
RUN a2enmod rewrite

# MySQL support
RUN docker-php-ext-install mysqli

# Project files copy
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80
