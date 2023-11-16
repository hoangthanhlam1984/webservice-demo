FROM trafex/php-nginx

USER root

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /etc/nginx/conf.d/

USER 1000

RUN mkdir -p /var/www/webservice-demo

RUN chmod 1000:1000 /var/www/webservice-demo -R

WORKDIR /var/www/webservice-demo

EXPOSE 9000

COPY --chown=1000:1000 . /var/www/webservice-demo

COPY ./.deploy/dev/vhosts/*.* /etc/nginx/conf.d/

COPY .env.example .env

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate
RUN php artisan optimize
RUN chmod 777 ./storage -R

VOLUME [ "/projects/webservice-demo" ]
