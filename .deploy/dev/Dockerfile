# FROM wyveo/nginx-php-fpm:php74
FROM webdevops/php-nginx:7.4-alpine

EXPOSE 9100

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /etc/nginx/conf.d/
RUN mkdir -p /var/www/webservice-demo

WORKDIR /var/www/webservice-demo

COPY --chown=1000:1000 . /var/www/webservice-demo

# COPY ./.deploy/dev/vhosts/*.* /etc/nginx/conf.d/
COPY ./.deploy/dev/vhosts/*.* /opt/docker/etc/nginx/conf.d/

# COPY --chown=1000:1000 .env.example .env

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate
RUN php artisan optimize
RUN chmod 777 ./storage -R

USER www-data
