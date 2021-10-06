# Dart Runtime

## usage

```bash
docker build -t dart-runtime .
```

```bash
docker run -p 3000:3000 -v /your_code/path:/usr/src/app/user_code dart-runtime
```

The your function code must have `main.dart` and inside must have a `start(Request request, Response response)` function that returns a `Future`. Use `response.send` or `response.json` method to send the output.

## request

Requests can be done to any url on the choosen port. 

For an execution we need to perform a POST request with its body containing all necessary informations.

## request body

```json
{
    "file": "main.dart",

    // following will be exposed to the function
    "env": {
        // env variables
    },
    "payload": {
        // payload
    },
    "headers": {
        // headers
    }
}
```
