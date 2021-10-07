
echo 'Rust Packaging...'

rm $(pwd)/tests/resources/rust.tar.gz
tar -zcvf $(pwd)/tests/resources/rust.tar.gz -C $(pwd)/tests/resources/rust .