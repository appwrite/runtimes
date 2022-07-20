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

- [ ] Implement the runtime in [open-runtimes/open-runtimes](https://github.com/open-runtimes/open-runtimes) (you can find the tutorial [here](https://github.com/open-runtimes/open-runtimes/blob/main/docs/add-runtime.md))
  - [ ] Prepare the Readme for your new runtime. Make sure to mention the following details
    - [ ] Docker base image name + version
    - [ ] HTTP server library name
    - [ ] Any extra steps needed to get dependencies running (for e.g., `package.json`)
    - [ ] Copy the rest of the Readme from another existing runtime
  - [ ] Write the runtime
    - [ ] Initialize a web server
      - Use a library that supports `async/await`, also smaller/simpler libraries are preferred as this is a primitive HTTP server
      - [ ] Set Port 3000
      - [ ] Bind IP 0.0.0.0
      - On each POST Request
        - [ ] Check that the `x-internal-challenge header` matches the `INTERNAL_RUNTIME_KEY` environment variable
        - [ ] Decode the executor's JSON POST request
          - [ ] Make sure to have the right default values for Request body fields ([example](https://github.com/open-runtimes/open-runtimes/blob/main/runtimes/node-16.0/server.js#L14-L18))
           - [ ]  env: empty object
           - [ ]  headers: empty object
           - [ ]  payload: empty string
    - [ ] Create Request Class
      - [ ] Fields
        - [ ] env
        - [ ] payload
        - [ ] headers
    - [ ] Create Response Class
      - [ ] Functions
        - [ ] send(string data, int statusCode)
        - [ ] json(object data, int statusCode)
    - [ ] Execute the function
      - [ ] Add `try catch` block for error handling
  - [ ] Write the `build.sh` script
  - [ ] Write the `start.sh` script
  - [ ] Write the Dockerfile
    - [ ] Add the Docker image you want to base your runtime off
    - [ ] Create the folders you'll use
    - [ ] Copy your source code and set working directory
    - [ ] Add execute permissions for any scripts
      - [ ] `build.sh`
      - [ ] `start.sh`
    - [ ] Use `RUN` commands for necessary dependencies (if needed)
    - [ ] Expose port 3000
    - [ ] Add a `CMD` command for `start.sh`
  - [ ] Build your Docker image and add it to the script files
    - [ ] Add your runtime to the `./build.sh` script at the root of the project
  - [ ] Add test
    - [ ] Create a PHP file named by the language   
    - [ ] Create a new folder in `./tests` by the name of your runtime
    - [ ] Inside the folder, create a function ([example](https://github.com/open-runtimes/open-runtimes/blob/main/tests/node-16.0/tests.js))
      - [ ] Decode the payload as JSON
      - [ ] Set a string variable called `id` to the value of the `id` key in the payload or to `1` if it doesn't exist
      - [ ] Fetch `https://jsonplaceholder.typicode.com/todos/$id` with an HTTP Client installed from your language's package manager using the `id` variable
      - [ ] return `res.json`
    - [ ] Add runtime to Travis CI
      - [ ] Edit the `.travis.yml` file and add your runtime to the `env` section 
    - [ ] Run the test locally
    - [ ] Raise a PR
- [ ] Add the runtime to [appwrite/runtimes](https://github.com/appwrite/runtimes)
- [ ] Add runtime support to the CLI in [appwrite/sdk-generator](https://github.com/appwrite/sdk-generator/blob/master/templates/cli/lib/questions.js.twig)
  - [ ] Ignored files
  - [ ] Entrypoint
- [ ] Create a function starter in [appwrite/functions-starter](https://github.com/appwrite/functions-starter) (ensure that the file structure is same as the entrypoint in the CLI)
