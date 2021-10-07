
echo 'Dart Packaging...'

rm $(pwd)/tests/resources/dart.tar.gz
tar -zcvf $(pwd)/tests/resources/dart.tar.gz -C $(pwd)/tests/resources/dart .