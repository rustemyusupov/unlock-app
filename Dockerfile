FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && composer global require "hirak/prestissimo:^0.3"
