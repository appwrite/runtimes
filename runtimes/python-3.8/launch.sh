#!/bin/sh
mkdir -p /usr/code 
cp /tmp/code.tar.gz /usr/code.tar.gz 
cd /usr 
tar -zxf /usr/code.tar.gz -C /usr/code 
rm /usr/code.tar.gz
source /usr/code/runtime-env/bin/activate
cd /usr/local/src/
flask run --host=0.0.0.0 --port=3000