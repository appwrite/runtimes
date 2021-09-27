cd /usr/local/src/
composer update --no-interaction --ignore-platform-reqs --optimize-autoloader --no-scripts --prefer-dist --no-dev

cd /usr/code/
if [[ -f "composer.json" ]]; then
    composer update --no-interaction --ignore-platform-reqs --optimize-autoloader --no-scripts --prefer-dist --no-dev
fi