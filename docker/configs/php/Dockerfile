FROM php:8.1-fpm

RUN apt-get -y update && apt-get -y install git unzip vim
RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
# для 3-го xdebug port=9003 не указана версия
        && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini

ENV TERM xterm-256color

# спитати про комбінацію для прискорення віддачи динамічних сторінок
# RUN pecl install apcu-5.1.21
# RUN docker-php-ext-enable apcu opcache

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# краще перенести на початок
WORKDIR /srv/src/php-pro

# спитати про синхронізацію за секцію
#COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer
CMD [ "php-fpm"]