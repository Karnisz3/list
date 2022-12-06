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
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --$COMPOSER_VERSION && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# User + root directory
RUN adduser --no-create-home --uid 1000 dev && \
    mkdir /todo/ && \
    chown dev:dev /todo/

USER dev
WORKDIR /todo/

EXPOSE 8080
CMD php -S 0.0.0.0:8080 -t public