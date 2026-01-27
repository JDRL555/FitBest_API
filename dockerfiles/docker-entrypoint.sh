#!/bin/sh
# Aseguramos permisos cada vez que el contenedor arranca
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Luego ejecutamos lo que PHP-FPM tenga que hacer normalmente
exec php-fpm