FROM php:7.4-fpm-alpine

RUN mkdir -p /var/www/webservice-demo

WORKDIR /var/www/webservice-demo

EXPOSE 9000

COPY --chown=1000:1000 . /var/www/webservice-demo

COPY .env.example .env

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate
RUN php artisan optimize
RUN chmod 777 ./storage -R

VOLUME [ "/projects/webservice-demo" ]
