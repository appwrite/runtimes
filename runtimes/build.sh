echo 'Starting build...'

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