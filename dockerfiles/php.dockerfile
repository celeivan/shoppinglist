FROM php:8.1-fpm-alpine3.16
 
RUN mkdir -p /var/www/html
 
WORKDIR /var/www/html
 
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

# Copy the entrypoint.sh script to the container
COPY entrypoint.sh /entrypoint.sh

# Make the entrypoint.sh script executable
RUN chmod +x /entrypoint.sh

# Set the entrypoint to the entrypoint.sh script
ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
