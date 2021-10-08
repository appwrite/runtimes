#!/bin/sh
mkdir -p /usr/code 
cp /tmp/code.tar.gz /usr/code.tar.gz 
cd /usr 
tar -zxf /usr/code.tar.gz -C /usr/code 
rm /usr/code.tar.gz
cp -r /usr/code/vendor /usr/local/src/vendor
cd /usr/local/src/
bundle config set --local path 'vendor/bundle'
bundle exec puma -b tcp://0.0.0.0:3000 -e production