FROM php:8.3-fpm

RUN apt-get update

RUN apt-get install -y git
RUN apt-get install -y libpng-dev
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y libmagickwand-dev --no-install-recommends
RUN apt-get install -y libpq-dev

RUN docker-php-ext-configure gd -with-freetype
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer self-update

WORKDIR /var/www/cron-distributor

CMD ["php-fpm"]