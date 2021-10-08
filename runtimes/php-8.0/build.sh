#!/bin/sh

cd /usr/code
if [[ ! -f "composer.json" ]]; then
    mv /usr/local/src/composer.json.fallback /usr/code/composer.json
fi

cd /usr/local/src/
composer update --no-interaction --ignore-platform-reqs --optimize-autoloader --no-scripts --prefer-dist --no-dev

cp -r /usr/local/src/vendor /usr/code/vendor