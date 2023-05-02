FROM php:8.1-fpm as base

#install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# php part
RUN apt-get update \
    && apt-get install --yes --no-install-recommends \
      libxslt-dev \
      libzip-dev \
      libpq-dev \
      unzip \
      nginx \
      xz-utils \
      git \
      netcat \
    && docker-php-ext-install \
      xsl \
      zip \
      pdo \
      pdo_pgsql \
      opcache \
      pcntl \
      intl \
    && rm -rf /var/lib/apt/lists/*

# nginx
ARG S6_OVERLAY_VERSION=3.1.4.1

RUN apt-get update && apt-get install -y nginx xz-utils
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
CMD ["/usr/sbin/nginx"]

ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-noarch.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-noarch.tar.xz
ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-x86_64.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-x86_64.tar.xz

WORKDIR /var/www/html/
ENTRYPOINT ["/init"]
