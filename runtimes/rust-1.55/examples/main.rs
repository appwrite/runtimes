use super::{Response, RequestValue};
use serde_json::value::Value;

pub fn main(req: RequestValue) -> Response {
    return Response::json(json!({
        "hello": "world"
    }));
}