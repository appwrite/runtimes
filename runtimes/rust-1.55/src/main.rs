#[macro_use] extern crate rocket;
use serde_json::map::Map;

use rocket::serde::{Deserialize, json::{Value, Json}};

mod custom;

#[derive(Responder)]
pub enum Response {
    json(Value),
    send(String),
}

#[derive(Deserialize)]
pub struct RequestValue {
    path: Option<String>,
    file: Option<String>,
    env: Map<String, Value>,
    headers: Option<Map<String, Value>>,
    payload: String
}

#[post("/", format = "json", data = "<value>")]
fn index(value: Json<RequestValue>) -> Response {
    custom::main::main(value.into_inner())
}

#[launch]
fn rocket() -> _ {
    rocket::build().mount("/", routes![index])
}