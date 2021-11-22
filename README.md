# Appwrite Runtimes

[![Build Status](https://travis-ci.com/appwrite/php-runtimes.svg)](https://travis-ci.com/appwrite/php-runtimes)
![Total Downloads](https://img.shields.io/packagist/dt/appwrite/php-runtimes.svg)
[![Discord](https://img.shields.io/discord/564160730845151244?label=discord)](https://appwrite.io/discord)

Appwrite repository for Cloud Function runtimes that contains the configurations and tests for all of the Appwrite runtime environments. This library is maintained by the [Appwrite team](https://appwrite.io).

## Getting Started

Install using composer:
```bash
composer require appwrite/php-runtimes
```

```php
<?php

require_once '../vendor/autoload.php';

use Appwrite\Runtimes\Runtimes;

$runtimes = new Runtime();

// returns all supported cloud function runtimes
Runtimes::getAll();
```

## Adding a new Runtime

### 1. Docker

The first thing to do is to create a Dockerfile under `runtimes/`.

> Important features for a base image are small sizes (Alpine preferred), multi-architecture (x86, ARM, PPC) and active maintenance.

Example for a Dockerfile looks like this:

```dockerfile
# Base image
FROM mcr.microsoft.com/dotnet/runtime:5.0-alpine
# Maintainer label
LABEL maintainer="team@appwrite.io"
# Add tar (required for uncompressing functions)
RUN apk add tar
# Set working directory to /usr/local/src/
WORKDIR /usr/local/src/
```

After that the build command must be added to the `build.sh` script.

### 2. Add Runtime

After the Docker image is created, this must be added to the main class of this library.

References to this must be added to the constructor of `src/Runtimes/Runtimes.php`.

Example:

```php
$dotnet = new Runtime('dotnet', '.NET');
$dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'appwrite/env-dotnet-5.0:1.0.0', [System::X86, System::ARM]);
$runtimes[] = $dotnet;
```

### 3. Add Tests

First of all, a script for the runtime environment must be created. Plenty of examples can be found under `tests/resources`.

After that start options must be added to the `setUp()` method found in `tests/Runtimes/RuntimesTest.php`.

**WARNING:** On MacOS and Windows the `/tmp/builtCode/` needs to be created before the tests are run. This is due to a wierd permission issue on Docker Desktop that occours if the directory does not exist since Docker Desktop does not create it automatically.

## Authors

**Torsten Dittmann**

+ [https://twitter.com/dittmanntorsten](https://twitter.com/dittmanntorsten)
+ [https://github.com/torstendittmann](https://github.com/torstendittmann)

## Copyright and license

BSD 3-Clause License [https://opensource.org/licenses/BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)
