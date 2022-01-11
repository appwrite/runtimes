#!/bin/sh

# Copy User Code
cp -a /usr/code/. /usr/local/src/src/custom

# Rename Main Function Rust
mv /usr/local/src/src/custom/$ENTRYPOINT_NAME /usr/local/src/src/custom/main.rs

# Move to server directory
cd /usr/local/src

# Compile Code
cargo build --release

rm -r /usr/code/*

cp /usr/local/src/target/release/runtime /usr/code/
cp /usr/local/src/Rocket.toml /usr/code/