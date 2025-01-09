FROM --platform=$TARGETPLATFORM php:8.2-cli
RUN pecl install xdebug
COPY tests/Docker/php82/xdebug.ini $PHP_INI_DIR/conf.d/
