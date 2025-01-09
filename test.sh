#!/usr/bin/env bash

if [ -z "$(docker images -q phpdateimmutable_php84 2> /dev/null)" ]; then
    docker build \
        --build-arg BUILDKIT_INLINE_CACHE=1 \
        --cache-from phpdateimmutable_php84 \
        --file tests/Docker/php84/Dockerfile \
        --tag phpdateimmutable_php84 \
        .;
fi

if [ -z "$(docker images -q phpdateimmutable_php83 2> /dev/null)" ]; then
    docker build \
        --build-arg BUILDKIT_INLINE_CACHE=1 \
        --cache-from phpdateimmutable_php83 \
        --file tests/Docker/php83/Dockerfile \
        --tag phpdateimmutable_php83 \
        .;
fi

if [ -z "$(docker images -q phpdateimmutable_php82 2> /dev/null)" ]; then
    docker build \
        --build-arg BUILDKIT_INLINE_CACHE=1 \
        --cache-from phpdateimmutable_php82 \
        --file tests/Docker/php82/Dockerfile \
        --tag phpdateimmutable_php82 \
        .;
fi

docker run -it --rm \
    -v "$(pwd):/app" \
    -w /app \
    phpdateimmutable_php84 bash -c "php -d memory_limit=4G vendor/bin/pest --fail-on-warning";

docker run -it --rm \
    -v "$(pwd):/app" \
    -w /app \
    phpdateimmutable_php83 bash -c "php -d memory_limit=4G vendor/bin/pest --fail-on-warning";

docker run -it --rm \
    -v "$(pwd):/app" \
    -w /app \
    phpdateimmutable_php82 bash -c "XDEBUG_MODE=coverage php -d memory_limit=4G vendor/bin/pest --fail-on-warning --coverage --coverage-html tests/code-coverage/";
