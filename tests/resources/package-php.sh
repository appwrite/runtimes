
echo 'PHP Packaging...'

cp -r $(pwd)/tests/resources/php $(pwd)/tests/resources/packages/php

docker run --rm -v $(pwd)/tests/resources/packages/php:/app -w /app composer:2.0 composer install --ignore-platform-reqs

docker run --rm -v $(pwd)/tests/resources/packages/php:/app -w /app appwrite/env-php-8.0:1.0.0 tar -zcvf code.tar.gz .

mv $(pwd)/tests/resources/packages/php/code.tar.gz $(pwd)/tests/resources/php.tar.gz

rm -r $(pwd)/tests/resources/packages/php