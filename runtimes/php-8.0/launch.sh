#!/bin/sh
mkdir -p /usr/code 
cp /tmp/code.tar.gz /usr/code.tar.gz 
cd /usr 
tar -zxf /usr/code.tar.gz -C /usr/code 
rm /usr/code.tar.gz
cp -r /usr/code/vendor /usr/local/src/vendor
cd /usr/local/src/
php server.php