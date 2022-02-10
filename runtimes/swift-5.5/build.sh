#!/bin/sh

# Copy User Code
cp -a /usr/code/. /usr/local/src/Sources/App/Custom/

# Rename Main Function Swift
mv /usr/local/src/Sources/App/Custom/$ENTRYPOINT_NAME /usr/local/src/Sources/App/Custom/userCode.swift

# Move to server directory
cd /usr/local/src

# Compile Code
swift build -Xswiftc -static-executable

rm -r /usr/code/*

cp $(swift build --show-bin-path)/Run /usr/code/runtime