FROM php:7.4-fpm-alpine

RUN mkdir -p /projects/webservice-demo

RUN mkdir -p /docker/nginx/vhosts

WORKDIR /var/www/webservice-demo

EXPOSE 9000

COPY --chown=1000:1000 . .

COPY --chown=1000:1000 ./public/.htaccess /var/www/webservice-demo/public/.htaccess
COPY --chown=1000:1000 ./public/*.* /var/www/webservice-demo/public/

COPY --chown=1000:1000 ./.deploy/vhosts/*.* /etc/nginx/conf.d/

COPY .env.example .env

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate
RUN php artisan optimize
RUN chmod 777 ./storage -R

VOLUME [ "/projects/webservice-demo" ]
