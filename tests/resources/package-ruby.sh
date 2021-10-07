
echo 'Ruby Packaging...'

rm $(pwd)/tests/resources/ruby.tar.gz
tar -zcvf $(pwd)/tests/resources/ruby.tar.gz -C $(pwd)/tests/resources/ruby .