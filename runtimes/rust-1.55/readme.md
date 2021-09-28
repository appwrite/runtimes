# Rust Runtime 1.55

This is the Runtime that Appwrite uses to build rust code.

This Runtime is **not** used to run the compiled code. Instead the Appwrite Alpine image is used to maintain smaller footprint during execution.

## Notes:
All rust code must expose a public function called `main` which is the entry point for the code and must return a `Response` type which you can get from the `super::` crate.

`Response` is a struct that has two functions:
`send` and `json` you can return either one of these functions.

`send` is used to send a string response to the client and accepts a `String` type.

`json` is used to send a json response to the client and accepts a `serde_json::Value` type.

String Example:
```rust
use super::{Response, RequestValue};

pub fn main(req: RequestValue) -> Response {
    return Response::send("test".to_string());
}
```

JSON Example:
```rust
use super::{Response, RequestValue};
use serde_json::value::Value;

pub fn main(req: RequestValue) -> Response {
    return Response::json(json!({
        "test": "test"
    }));
}
```