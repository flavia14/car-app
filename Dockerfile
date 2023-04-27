FROM php:8.1-fpm as base

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nginx

FROM nginx
COPY nginx/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www/

ENTRYPOINT ["/init"]

