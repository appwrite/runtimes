# Contributing

We would ❤️ for you to contribute to Appwrite and help make it better! As a contributor, here are the guidelines we would like you to follow:

## Code of Conduct

Help us keep Appwrite open and inclusive. Please read and follow our [Code of Conduct](/CODE_OF_CONDUCT.md).

## Installation

To install a working development environment follow these instructions:

1. Fork or clone the appwrite/php-runtimes repository.

2. Install Composer dependencies using one of the following options:

**Composer CLI**
```bash
composer update --ignore-platform-reqs --optimize-autoloader --no-plugins --no-scripts --prefer-dist
```

**Docker (UNIX)**

```bash
docker run --rm --interactive --tty --volume "$(pwd)":/app composer update --ignore-platform-reqs --optimize-autoloader --no-plugins --no-scripts --prefer-dist
```

**Docker (Windows)**

```bash
docker run --rm --interactive --tty --volume "%cd%":/app composer update --ignore-platform-reqs --optimize-autoloader --no-plugins --no-scripts --prefer-dist
```

4. Build all runtimes locally by running the following command within the project root:
```
./runtimes/buildLocalOnly.sh
```

3. [Follow our contribution guide to learn how you can add support for more runtimes.](https://github.com/appwrite/php-runtimes/blob/refactor/docs/adding-a-new-runtime.md)

