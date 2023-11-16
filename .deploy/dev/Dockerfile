# FROM wyveo/nginx-php-fpm:php74
FROM webdevops/php-nginx:7.4-alpine

EXPOSE 9000

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /etc/nginx/conf.d/
RUN mkdir -p /var/www/webservice-demo

WORKDIR /var/www/webservice-demo

USER www-data

COPY --chown=1000:1000 . /var/www/webservice-demo

COPY --chown=1000:1000 ./.deploy/dev/vhosts/*.* /etc/nginx/conf.d/
# COPY ./.deploy/dev/vhosts/*.* /opt/docker/etc/nginx/conf.d/

COPY --chown=1000:1000 .env.example .env

# RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN composer install

RUN php artisan key:generate
RUN php artisan optimize
RUN chmod 777 ./storage -R

# VOLUME [ "/projects/webservice-demo" ]

# RUN usermod -u 1000 www-data &&\
#     groupmod -g 1000 www-data

USER www-data
