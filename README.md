# Appwrite Runtimes

[![Discord](https://img.shields.io/discord/564160730845151244?label=discord&style=flat-square)](https://appwrite.io/discord?r=Github)
![Total Downloads](https://img.shields.io/packagist/dt/appwrite/php-runtimes.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/com/appwrite/php-runtimes?style=flat-square)](https://travis-ci.com/appwrite/php-runtimes)
[![Twitter Account](https://img.shields.io/twitter/follow/appwrite?color=00acee&label=twitter&style=flat-square)](https://twitter.com/appwrite)

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

After the Docker image is created, this must be added to the main class of this library.

References to this must be added to the constructor of `src/Runtimes/Runtimes.php`.

Example:

```php
$dotnet = new Runtime('dotnet', '.NET');
$dotnet->addVersion('5.0', 'mcr.microsoft.com/dotnet/runtime:5.0-alpine', 'appwrite/env-dotnet-5.0:1.0.0', [System::X86, System::ARM]);
$runtimes[] = $dotnet;
```

## Contributing

All code contributions - including those of people having commit access - must go through a pull request and approved by a core developer before being merged. This is to ensure proper review of all the code.

We truly ❤️ pull requests! If you wish to help, you can learn more about how you can contribute to this project in the [contribution guide](CONTRIBUTING.md).

## Authors

**Torsten Dittmann**

+ [https://twitter.com/dittmanntorsten](https://twitter.com/dittmanntorsten)
+ [https://github.com/torstendittmann](https://github.com/torstendittmann)

## Copyright and license

BSD 3-Clause License [https://opensource.org/licenses/BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)
