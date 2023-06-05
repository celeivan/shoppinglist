#!/bin/sh
set -e

# Run the additional command
/usr/local/bin/php /var/www/html/setup.php &

# Execute the original CMD
exec php-fpm -y /usr/local/etc/php-fpm.conf -R
