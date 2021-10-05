#!/bin/sh

# Move to server directory
cd /usr/local/src

# Get dependencies
dart pub get

# Compile the Code
dart compile exe bin/server.dart -o build/runtime

rm -r /usr/code/*

cp /usr/local/src/build/runtime /usr/code/