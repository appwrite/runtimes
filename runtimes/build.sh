echo 'Starting build...'

echo 'Deno 1.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-deno:1.5 ./runtimes/deno-1.5/ --push

echo 'Deno 1.6...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-deno:1.6 ./runtimes/deno-1.6/ --push

echo 'Deno 1.8...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.8 ./runtimes/deno-1.8/ --push

echo 'Deno 1.10...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.10 ./runtimes/deno-1.10/ --push

echo 'Deno 1.11...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.11 ./runtimes/deno-1.11/ --push

echo 'Deno 1.12...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.12 ./runtimes/deno-1.12/ --push

echo 'Deno 1.13...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.13 ./runtimes/deno-1.13/ --push

echo 'Deno 1.14...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/runtime-for-deno:1.14 ./runtimes/deno-1.14/ --push

echo 'Node 14.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/runtime-for-node:14.5 ./runtimes/node-14.5/ --push

echo 'Node 15.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/runtime-for-node:15.5 ./runtimes/node-15.5/ --push

echo 'Node 16...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/runtime-for-node:16.0 ./runtimes/node-16.0/ --push

echo 'Node 17...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/runtime-for-node:17.0 ./runtimes/node-17.0/ --push

echo 'PHP 7.4...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-php:7.4 ./runtimes/php-7.4/ --push

echo 'PHP 8.0...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-php:8.0 ./runtimes/php-8.0/ --push

echo 'PHP 8.1...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-php:8.1 ./runtimes/php-8.1/ --push

echo 'Python 3.8...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-python:3.8 ./runtimes/python-3.8/ --push

echo 'Python 3.9...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-python:3.9 ./runtimes/python-3.9/ --push

echo 'Python 3.10...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386 -t appwrite/runtime-for-python:3.10 ./runtimes/python-3.10/ --push

echo 'Ruby 2.7...'
docker buildx build --platform linux/amd64,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-ruby:2.7 ./runtimes/ruby-2.7/ --push

echo 'Ruby 3.0...'
docker buildx build --platform linux/amd64,linux/arm64,linux/386,linux/ppc64le -t appwrite/runtime-for-ruby:3.0 ./runtimes/ruby-3.0/ --push

echo 'Dart 2.10...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-dart:2.10 ./runtimes/dart-2.10/ --push

echo 'Dart 2.12...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-dart:2.12 ./runtimes/dart-2.12/ --push

echo 'Dart 2.13...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-dart:2.13 ./runtimes/dart-2.13/ --push

echo 'Dart 2.14...'
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7 -t appwrite/runtime-for-dart:2.14 ./runtimes/dart-2.14/ --push

echo 'Dart 2.15...'
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7 -t appwrite/runtime-for-dart:2.15 ./runtimes/dart-2.15/ --push

echo '.NET 3.1...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-dotnet:3.1 ./runtimes/dotnet-3.1/ --push

echo '.NET 5.0...'
docker buildx build --platform linux/amd64,linux/arm64 -t appwrite/runtime-for-dotnet:5.0 ./runtimes/dotnet-5.0/ --push

echo 'Java 11...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-java:11.0 ./runtimes/java-11.0/ --push

echo 'Java 16...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-java:16.0 ./runtimes/java-16.0/ --push

echo 'Java 17...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-java:17.0 ./runtimes/java-17.0/ --push

echo 'Swift 5.5...'
docker buildx build --platform linux/amd64 -t appwrite/runtime-for-swift:5.5 ./runtimes/swift-5.5/ --push
