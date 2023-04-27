FROM php:8.1-fpm as base

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nginx

FROM nginx
COPY nginx/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www/html
