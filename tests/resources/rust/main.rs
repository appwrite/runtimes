use super::{Response, RequestValue};
use rocket::serde::json::{json, Json, Value};

pub fn main(req: RequestValue) -> Response {
    return Response::json(
        json!({
            "normal": "Hello World!",
            "env1": req.env.get("ENV1").unwrap().as_str(),
            "payload": req.payload
        })
    );
}