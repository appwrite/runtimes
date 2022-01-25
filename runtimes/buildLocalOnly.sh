echo 'Starting build...'

echo 'Dart 2.12...'
docker build -t dart-runtime:2.12 ./runtimes/dart-2.12 || true

echo 'Dart 2.13...'
docker build -t dart-runtime:2.13 ./runtimes/dart-2.13 || true

echo 'Dart 2.14...'
docker build -t dart-runtime:2.14 ./runtimes/dart-2.14 || true

echo 'Dart 2.15...'
docker build -t dart-runtime:2.15 ./runtimes/dart-2.15 || true

echo 'Deno 1.12...'
docker build -t deno-runtime:1.12 ./runtimes/deno-1.12 || true

echo 'Deno 1.13...'
docker build -t deno-runtime:1.13 ./runtimes/deno-1.13 || true

echo 'Deno 1.14...'
docker build -t deno-runtime:1.14 ./runtimes/deno-1.14 || true

echo 'Node 14.5...'
docker build -t node-runtime:14.5 ./runtimes/node-14.5 || true

echo 'Node 15.5...'
docker build -t node-runtime:15.5 ./runtimes/node-15.5 || true

echo 'Node 16...'
docker build -t node-runtime:16.0 ./runtimes/node-16.0 || true

echo 'Node 17...'
docker build -t node-runtime:17.0 ./runtimes/node-17.0 || true

echo 'PHP 8.0...'
docker build -t php-runtime:8.0 ./runtimes/php-8.0 || true

echo 'PHP 8.1...'
docker build -t php-runtime:8.0 ./runtimes/php-8.0 || true

echo 'Python 3.8...'
docker build -t python-runtime:3.8 ./runtimes/python-3.8 || true

echo 'Python 3.9...'
docker build -t python-runtime:3.9 ./runtimes/python-3.9 || true

echo 'Python 3.10...'
docker build -t python-runtime:3.10 ./runtimes/python-3.10 || true

echo 'Rust 1.55'
docker build -t rust-runtime:1.55 ./runtimes/rust-1.55 || true

echo 'Ruby 3.0'
docker build -t ruby-runtime:3.0 ./runtimes/ruby-3.0 || true

echo 'Alpine 3.13.6...'
docker build -t appwrite-alpine:3.13.6 ./runtimes/alpine-3.13.6 || true

echo 'Ubuntu 20.04'
docker build -t appwrite-ubuntu:20.04 ./runtimes/ubuntu-20.04 || true

echo 'Java 16.0...'
docker build -t java-runtime:16.0 ./runtimes/java-16.0 || true

echo 'Swift 5.5...'
docker build -t swift-runtime:5.5 ./runtimes/swift-5.5 || true
