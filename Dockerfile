FROM php:8.1-fpm

RUN apt-get update && apt-get install --yes --no-install-recommends \
    nginx  \
    supervisor \
    curl \
    git \
    unzip \
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
    opcache \
    pcntl \
    intl \
&& rm -rf /var/lib/apt/lists/*
# Install PHP extensions required by Symfony
RUN docker-php-ext-install pdo_mysql
# Set timezone
RUN ln -fs /usr/share/zoneinfo/Europe/London /etc/localtime && \
dpkg-reconfigure --frontend noninteractive tzdata
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Create a directory for the application files
RUN mkdir -p /var/www/html
# Set the working directory
WORKDIR /var/www/html
# Copy the application files to the container
COPY . /var/www/html
# Install dependencies using Composer
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && \
composer clear-cache
# Generate optimized class autoloader
RUN composer dump-autoload --no-scripts --optimize
# Remove the default Nginx configuration file
RUN rm /etc/nginx/sites-enabled/default
# Copy the Nginx configuration file to the container
COPY ./setup/nginx.conf /etc/nginx/sites-enabled/
# Copy the supervisord configuration file to the container
COPY ./setup/supervisord.conf /etc/supervisor/conf.d/
# Expose ports
EXPOSE 80
# Start supervisord
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
