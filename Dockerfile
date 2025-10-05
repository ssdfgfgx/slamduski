# Use PHP with Apache
FROM php:8.3-apache

# Copy local files to Apache root
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
