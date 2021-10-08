echo 'PHP Packaging...'

rm $(pwd)/tests/resources/php.tar.gz
tar -zcvf $(pwd)/tests/resources/php.tar.gz -C $(pwd)/tests/resources/php .