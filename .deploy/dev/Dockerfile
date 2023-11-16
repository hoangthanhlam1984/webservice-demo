FROM trafex/php-nginx

USER root

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN --chown=1000:1000 mkdir -p /etc/nginx/conf.d/
RUN --chown=1000:1000 mkdir -p /var/www/webservice-demo


# RUN chown 1000:1000 /var/www/webservice-demo -R

WORKDIR /var/www/webservice-demo

EXPOSE 9000

COPY --chown=1000:1000 . /var/www/webservice-demo

COPY --chown=1000:1000 ./.deploy/dev/vhosts/*.* /etc/nginx/conf.d/

COPY --chown=1000:1000 .env.example .env

RUN --chown=1000:1000 composer install --no-interaction --optimize-autoloader --no-dev

RUN --chown=1000:1000 php artisan key:generate
RUN --chown=1000:1000 php artisan optimize
RUN --chown=1000:1000 chmod 777 ./storage -R

VOLUME [ "/projects/webservice-demo" ]

