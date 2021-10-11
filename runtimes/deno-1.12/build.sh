#!/bin/sh

mkdir -p /usr/code/denoCache

# Set Deno Cache directory
export DENO_DIR="/usr/code/denoCache"

# Cache Server Depdenencies
cd /usr/local/src/
deno cache server.ts

# Cache user function depdenencies
cd /usr/code
deno cache $APPWRITE_ENTRYPOINT_NAME
