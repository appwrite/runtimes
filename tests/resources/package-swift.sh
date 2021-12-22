
echo 'Swift Packaging...'

rm $(pwd)/tests/resources/swift.tar.gz
tar -zcvf $(pwd)/tests/resources/swift.tar.gz -C $(pwd)/tests/resources/swift .