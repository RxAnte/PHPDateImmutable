FROM --platform=$TARGETPLATFORM php:8.3-cli
RUN pecl install xdebug
COPY tests/Docker/php83/xdebug.ini $PHP_INI_DIR/conf.d/
