FROM php:8.1-fpm as base

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


COPY . /home/oem/code/individualProject/CarApp
WORKDIR /home/oem/code/individualProject/CarApp

CMD [ "php", "./public/index.php" ]
