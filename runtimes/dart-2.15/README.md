# Dart Runtime 2.15
A runtime container for Dart 2.15
Developed to easily run and build Dart Code within a container.

## Creating a function for the runtime
To create a function for the runtime, you must create a asyncronous Dart function that returns a `Future<void>`. It must take two parameters, `Request` and `Response` in that order. what you can expect these types to contain can be found below in the `Custom Structures/Classes` section.

The function **must** be named `start` otherwise it will not compile.

## Handling User Dependencies
To install your own dependencies for your code you can add a `pubspec.yaml` file to the root of your function. Dependencies in this file will automatically be installed for you.

## Types

Types can be found [here.](function_types)

You can also import them into your IDE by adding the following to the `pubspec.yaml` file of your function:
```yaml
dependencies:
  appwrite-function-types:
    git: 
      url: https://github.com/appwrite/function-types.git
      ref: dart-2.15
```


## Running the runtime manually without an executor
Running the runtime without an executor is possible by following the steps below.

### 1. Building the image

The Docker image for this runtime must be built before it can be used.

Within the directory of the runtime you must run the following command:
```bash
docker build -t dart-runtime:2.15 .
```

### 2. Building the Code

You can run the following command to build the code in the directory where your code is located:
```bash
docker run -it --rm -v $(pwd)/YourDartFileName.dart:/usr/code/main.dart -v $(pwd)/code:/usr/code dart-runtime:2.15 /usr/local/src/build.sh
```

Make sure to replace `YourDartFileName.dart` with the name of your file.

After running the command if it's successful you should now have a folder called `code` which has a `runtime` executable within it.

Next you want to tarball the `code` folder, so within the code folder you can run the following command:
```bash
tar -czvf ./code.tar.gz ./
```
This should create a file called `code.tar.gz` which can be used for running the code on the runtime.

### 3. Running the Code Server

With the `code.tar.gz` file you can now run the following command to launch the runtime on port 3000:
```bash
docker run -it -p 3000:3000 -e INTERNAL_RUNTIME_KEY=TheRuntimeKeyYouWant --rm -v $(pwd)/code.tar.gz:/tmp/code.tar.gz dart-runtime:2.15 /usr/local/src/launch.sh
```
This launches the runtime server and allows you to now make requests to the runtime. You can also run the following command to launch the runtime in a detached mode:
```bash
docker run -d -p 3000:3000 -e INTERNAL_RUNTIME_KEY=TheRuntimeKeyYouWant --rm -v $(pwd)/code.tar.gz:/tmp/code.tar.gz dart-runtime:2.15 /usr/local/src/launch.sh
```

Note: The runtime does not output anything to the terminal, so if you see no output upon launch that's completely normal.

### 4. Making a Request to Execute the Code

To make a request to the runtime you can use your favorite HTTP client.

You have to send a `POST` request to `localhost:3000` with the following JSON body:
```json
{
    "file": "main.dart",
    "path": "/usr/code",
    "env": {
    },
    "timeout": 60,
    "payload": "", 
    "headers": {
    }
}
```
The header `x-internal-challenge` must be set to the value of the `INTERNAL_RUNTIME_KEY` environment variable.
`file` is the name of the file you want to execute. However in a statically compiled runtime like Dart this is not used.
`path` is the path to the directory where the code is located. This is not used due to Dart being statically compiled.

`env` is a map of environment variables that will be set when the code is executed. This is available to the user code through the `Request` class.
`timeout` is the amount of time in seconds that the code will be allowed to run before it is killed. This is currently not used in most runtimes due to alot of languages don't allow killing async functions.
`payload` is the payload that will be sent to the code. This is available to the user code through the `Request` class.
`headers` is a map of headers that will be sent to the code. This is available to the user code through the `Request` class.

If execution is successful you'll get a response of whatever your code returns using the `Response` class.

## Footguns to note
 - This image does not support ARM, upgrade to `dart-2.14` for ARM support.

## Example Code

```dart
import 'dart:async';
import 'package:function_types/function_types.dart';

Future<void> start(Request request, Response response) async {
  response.json({
    'Hello': 'World!'
  });
}
```

## Credits
**Damodar Lohani**
 - [GitHub](https://github.com/lohanidamodar/)