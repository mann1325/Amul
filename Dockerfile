# Use the official PHP + Apache image
FROM php:8.2-apache

# Copy all project files to the Apache web root
COPY . /var/www/html/

# Enable common PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 for web access
EXPOSE 80
