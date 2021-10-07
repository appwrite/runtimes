echo 'Node Packaging...'

rm $(pwd)/tests/resources/node.tar.gz
tar -zcvf $(pwd)/tests/resources/node.tar.gz -C $(pwd)/tests/resources/node .