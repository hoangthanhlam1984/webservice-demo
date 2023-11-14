FROM php:7.4-fpm-alpine

COPY . .

COPY .env.example .env

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate
RUN php artisan optimize
