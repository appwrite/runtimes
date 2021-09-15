
echo 'Node Packaging...'

cp -r $(pwd)/tests/resources/node $(pwd)/tests/resources/packages/node

docker run --rm -v $(pwd)/tests/resources/packages/node:/app -w /app appwrite/env-node-14.5:1.0.0 npm install

docker run --rm -v $(pwd)/tests/resources/packages/node:/app -w /app appwrite/env-node-14.5:1.0.0 tar -zcvf code.tar.gz .

mv $(pwd)/tests/resources/packages/node/code.tar.gz $(pwd)/tests/resources/node.tar.gz

rm -r $(pwd)/tests/resources/packages/node
