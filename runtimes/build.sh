echo 'Starting build...'

echo 'Deno 1.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-deno-1.5:1.0.0 ./runtimes/deno-1.5/ --push

echo 'Deno 1.6...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-deno-1.6:1.0.0 ./runtimes/deno-1.6/ --push

echo 'Deno 1.8...'
docker buildx build --platform linux/amd64,linux/386 -t appwrite/env-deno-1.8:1.0.0 ./runtimes/deno-1.8/ --push

echo 'Node 14.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/env-node-14.5:1.0.0 ./runtimes/node-14.5/ --push

echo 'Node 15.5...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/ppc64le -t appwrite/env-node-15.5:1.0.0 ./runtimes/node-15.5/ --push

echo 'PHP 7.4...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-php-7.4:1.0.0 ./runtimes/php-7.4/ --push

echo 'PHP 8.0...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-php-8.0:1.0.0 ./runtimes/php-8.0/ --push

echo 'Python 3.8...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-python-3.8:1.0.0 ./runtimes/python-3.8/ --push

echo 'Python 3.9...'
docker buildx build --platform linux/amd64,linux/arm/v6,linux/arm/v7,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-python-3.9:1.0.0 ./runtimes/python-3.9/ --push

echo 'Ruby 2.7...'
docker buildx build --platform linux/amd64,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-ruby-2.7:1.0.2 ./runtimes/ruby-2.7/ --push

echo 'Ruby 3.0...'
docker buildx build --platform linux/amd64,linux/arm64,linux/386,linux/ppc64le -t appwrite/env-ruby-3.0:1.0.0 ./runtimes/ruby-3.0/ --push

echo 'Dart 2.10...'
docker buildx build --platform linux/amd64 -t appwrite/env-dart-2.10:1.0.0 ./runtimes/dart-2.10/ --push

echo 'Dart 2.12...'
docker buildx build --platform linux/amd64 -t appwrite/env-dart-2.12:1.0.0 ./runtimes/dart-2.12/ --push

echo 'Dart 2.13...'
docker buildx build --platform linux/amd64 -t appwrite/env-dart-2.13:1.0.0 ./runtimes/dart-2.13/ --push

echo '.NET 3.1...'
docker buildx build --platform linux/amd64 -t appwrite/env-dotnet-3.1:1.0.0 ./runtimes/dotnet-3.1/ --push

echo '.NET 5.0...'
docker buildx build --platform linux/amd64,linux/arm64 -t appwrite/env-dotnet-5.0:1.0.0 ./runtimes/dotnet-5.0/ --push

echo 'Java 11...'
docker buildx build --platform linux/amd64 -t appwrite/env-java-11:1.0.0 ./runtimes/java-11/ --push

echo 'Java 16...'
docker buildx build --platform linux/amd64 -t appwrite/env-java-16:1.0.0 ./runtimes/java-16/ --push