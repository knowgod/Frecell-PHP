# "xdebug-2.9.0" for PHP<=7.4 — "xdebug" (3) for PHP>=8
ARG XDEBUG_VERSION="xdebug-2.9.0"

FROM php:7.4-cli

RUN yes | pecl install ${XDEBUG_VERSION}
#RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -type f -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini
#RUN echo "xdebug.remote_enable=on" 		>> /usr/local/etc/php/conf.d/xdebug.ini \
# && echo "xdebug.remote_autostart=off" 	>> /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=composer:1.10 /usr/bin/composer /usr/local/bin/composer

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./bin/shuffle" ]
