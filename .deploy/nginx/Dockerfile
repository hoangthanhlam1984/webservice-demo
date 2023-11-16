FROM nginxinc/nginx-unprivileged:1.18-alpine

USER root

RUN mkdir -p /var/www

RUN COPY ./.deploy/nginx/vhosts/*.* /etc/nginx/conf.d/

WORKDIR /var/www
