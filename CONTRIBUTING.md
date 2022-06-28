# Contributing

We would ❤️ for you to contribute to Appwrite and help make it better! As a contributor, here are the guidelines we would like you to follow:

## Code of Conduct

Help us keep Appwrite open and inclusive. Please read and follow our [Code of Conduct](/CODE_OF_CONDUCT.md).

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

## Function Runtimes Checklist

The following checklist aims to ensure that a function runtime gets added successfully

- [ ] Add the runtime to [open-runtimes/open-runtimes](https://github.com/open-runtimes/open-runtimes)
- [ ] Publish the runtime Docker image
- [ ] Add the runtime to [appwrite/runtimes](https://github.com/appwrite/runtimes)
- [ ] Create a function starter in [appwrite/functions-starter](https://github.com/appwrite/functions-starter)
- [ ] Add runtime support to the CLI in [appwrite/sdk-generator](https://github.com/appwrite/sdk-generator/blob/master/templates/cli/lib/questions.js.twig)