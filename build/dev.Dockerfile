FROM php:8.1

# Libraries versions
ARG XDEBUG_VERSION=3.1.6
ARG RDKAFKA_VERSION=6.0.3
ARG COMPOSER_VERSION=2.2

# Extensions dependencies
RUN apt-get update && apt-get install -y libzip-dev librdkafka-dev

# Extensions
RUN docker-php-ext-install opcache zip pdo pdo_mysql && \
    pecl install xdebug-$XDEBUG_VERSION && \
    pecl install rdkafka-$RDKAFKA_VERSION && \
    docker-php-ext-enable xdebug rdkafka

# Extensions configurations
COPY ./build/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/
COPY ./build/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --$COMPOSER_VERSION

# User + root directory
RUN adduser --no-create-home --uid 1000 dev && \
    mkdir /todo/ && \
    chown dev:dev /todo/

USER dev
WORKDIR /todo/

EXPOSE 8080
CMD php -S 0.0.0.0:8080 -t public