echo 'Starting build...'

echo 'Dart 2.12...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386 -t dart-runtime:2.12 ./runtimes/dart-2.12/ --push

echo 'Deno 1.14...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386 -t deno-runtime:1.14 ./runtimes/deno-1.14/ --push

echo 'Node 14.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t node-runtime:14.5 ./runtimes/node-14.5/ --push

echo 'Node 15.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t node-runtime-node:15.5 ./runtimes/node-15.5/ --push

echo 'Node 16...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t node-runtime:16.0 ./runtimes/node-16.0/ --push

echo 'PHP 8...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t php-runtime:8.0 ./runtimes/php-8.0/ --push

echo 'Python 3.8...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t python-runtime:3.8 ./runtimes/python-3.8/ --push

echo 'Python 3.8...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t python-runtime:3.9 ./runtimes/python-3.9/ --push

echo 'Rust 1.55.'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t rust-runtime:1.55 ./runtimes/rust-1.55/ --push

echo 'Ubuntu 20.04...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t ubuntu-runtime:20.04 ./runtimes/ubuntu-20.04/ --push

echo 'Alpine 3.13.6...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64 -t alpine-runtime:3.13.6 ./runtimes/alpine-3.13.6/ --push