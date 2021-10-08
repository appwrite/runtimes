echo 'Starting build...'

echo 'Dart 2.12...'
docker build -t dart-runtime:2.12 ./runtimes/dart-2.12

echo 'Dart 2.13...'
docker build -t dart-runtime:2.13 ./runtimes/dart-2.13

echo 'Dart 2.14...'
docker build -t dart-runtime:2.14 ./runtimes/dart-2.14

echo 'Deno 1.14...'
docker build -t deno-runtime:1.14 ./runtimes/deno-1.14

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

echo 'Rust 1.55'
docker build -t rust-runtime:1.55 ./runtimes/rust-1.55

echo 'Ruby 3.0'
docker build -t ruby-runtime:3.0 ./runtimes/ruby-3.0

echo 'Alpine 3.13.6...'
docker build -t appwrite-alpine:3.13.6 ./runtimes/alpine-3.13.6

echo 'Ubuntu 20.04'
docker build -t appwrite-ubuntu:20.04 ./runtimes/ubuntu-20.04

echo 'Java 16.0...'
docker build -t java-runtime:16.0 ./runtimes/java-16.0