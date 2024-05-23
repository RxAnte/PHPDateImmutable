#!/usr/bin/env bash

XDEBUG_MODE=coverage php -d memory_limit=4G ./vendor/bin/pest --fail-on-warning --coverage --coverage-html tests/code-coverage/
