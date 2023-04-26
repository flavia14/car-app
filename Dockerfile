FROM php:8.1-fpm as base
WORKDIR /home/oem/code/individualProject/CarApp

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
      pcntl \
      intl \
    && rm -rf /var/lib/apt/lists/*


FROM trafex/php-nginx:latest

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Run composer install to install the dependencies
RUN composer install --optimize-autoloader --no-interaction --no-progress

COPY . /home/oem/code/individualProject/CarApp

RUN composer install \
  --optimize-autoloader \
  --no-interaction \
  --no-progress

# continue stage build with the desired image and copy the source including the
# dependencies downloaded by composer
FROM trafex/php-nginx
COPY --chown=nginx --from=composer /app /var/www/html

