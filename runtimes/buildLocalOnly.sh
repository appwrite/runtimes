echo 'Starting build...'

echo 'Deno 1.13...'
docker build -t deno-runtime:1.13 ./runtimes/deno-1.13

echo 'Node 14.5...'
docker build -t node-runtime:14.5 ./runtimes/node-14.5

echo 'Node 15.5...'
docker build -t node-runtime:15.5 ./runtimes/node-15.5

echo 'Node 16...'
docker build -t node-runtime:16.0 ./runtimes/node-16.0

echo 'PHP 8...'
docker build -t php-runtime:8.0 ./runtimes/php-8.0

echo 'Python 3.8...'
docker build -t python-runtime:3.8 ./runtimes/python-3.8

echo 'Python 3.9...'
docker build -t python-runtime:3.9 ./runtimes/python-3.9

echo 'Java 16.0...'
docker build -t java-runtime:16.0 ./runtimes/java-16.0