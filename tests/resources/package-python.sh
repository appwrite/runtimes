
echo 'Python Packaging...'

rm $(pwd)/tests/resources/python.tar.gz
tar -zcvf $(pwd)/tests/resources/python.tar.gz -C $(pwd)/tests/resources/python .