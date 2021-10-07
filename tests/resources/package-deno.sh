echo 'Deno Packaging...'

rm $(pwd)/tests/resources/deno.tar.gz
tar -zcvf $(pwd)/tests/resources/deno.tar.gz -C $(pwd)/tests/resources/deno .