#!/bin/sh

# Copy User Code
cp -a /usr/code/. /usr/local/src/user_code

# Rename Main Function Dart
mv /usr/local/src/user_code/$APPWRITE_ENTRYPOINT_NAME /usr/local/src/user_code/main.dart

cd /usr/local/src/user_code

# Add a pubspec.yaml if one doesn't already exist.
if [[ ! -f "pubspec.yaml" ]]; then
    mv /usr/local/src/pubspec.yaml.fallback /usr/local/src/user_code/pubspec.yaml
fi

# Move to server directory
cd /usr/local/src

# Get dependencies
dart pub get

# Compile the Code
dart compile exe server.dart -o runtime

rm -r /usr/code/*

cp /usr/local/src/runtime /usr/code/