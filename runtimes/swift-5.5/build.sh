#!/bin/sh

# Copy User Code
cp -a /usr/code/. /usr/local/src/Sources/App/Custom/

# Rename Main Function Rust
mv /usr/local/src/Sources/App/Custom/$APPWRITE_ENTRYPOINT_NAME /usr/local/src/Sources/App/Custom/userCode.swift

# Move to server directory
cd /usr/local/src

# Compile Code
swift build

rm -r /usr/code/*

cp /usr/local/src/target/release/runtime /usr/code/