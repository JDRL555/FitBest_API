FROM php:8.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copiamos el script
COPY dockerfiles/docker-entrypoint.sh /usr/local/bin/

# Le damos permisos de ejecucion al script
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Le decimos a Docker que este es el comando de arranque
ENTRYPOINT ["docker-entrypoint.sh"]