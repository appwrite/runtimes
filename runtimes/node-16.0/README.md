# usage

```bash
docker build -t node-runtime .
```

```bash
docker run -p 3000:3000 -v /your_code/path:/usr/code node-runtime
```

# request

Requests can be done to any url on the choosen port. 

For an execution we need to perform a POST request with its body containing all necessary informations.

## request body

```json
{
    "path": "/usr/code",
    "file": "index.js",

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
