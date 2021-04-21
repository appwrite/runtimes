# Appwrite/php-runtimes

[![Build Status](https://travis-ci.org/appwrite/php-runtimes.svg?branch=master)](https://travis-ci.com/appwrite/php-runtimes)
![Total Downloads](https://img.shields.io/packagist/dt/appwrite/php-runtimes.svg)
[![Discord](https://img.shields.io/discord/564160730845151244?label=discord)](https://appwrite.io/discord)

Appwrite repository for Cloud Function runtimes. This library is maintained by the [Appwrite team](https://appwrite.io).

## Getting Started

Install using composer:
```bash
composer require appwrite/php-runtimes
```

```php
<?php

require_once '../vendor/autoload.php';

use Appwrite\Runtimes\Runtimes;

// returns all cloud function runtimes
Runtimes::get()

```

## Authors

**Torsten Dittmann**

+ [https://twitter.com/dittmanntorsten](https://twitter.com/dittmanntorsten)
+ [https://github.com/torstendittmann](https://github.com/torstendittmann)

## Copyright and license

BSD 3-Clause License [https://opensource.org/licenses/BSD-3-Clause](https://opensource.org/licenses/BSD-3-Clause)