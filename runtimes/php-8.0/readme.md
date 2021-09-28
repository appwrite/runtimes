# PHP Runtime 8.0

This is the Runtime that Appwrite uses to both build and run PHP code.

The runtime itself uses Swoole as the Web Server to communicate between the Executor and the PHP code.

## Notes:
In order to install dependencies for PHP Code your composer.json **MUST** use `user/function` as it's namespace in the `composer.json` like so:

```json
    "name": "user/function",
    "require": {
        "appwrite/appwrite": "1.1.*"
    }
```
This is just an example of how your composer.json should look like.