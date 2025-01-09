FROM --platform=$TARGETPLATFORM php:8.4-cli
RUN pecl install xdebug
COPY tests/Docker/php84/xdebug.ini $PHP_INI_DIR/conf.d/
