
echo 'Deno Packaging...'

cp -r $(pwd)/tests/resources/deno $(pwd)/tests/resources/packages/deno

docker run --rm -v $(pwd)/tests/resources/packages/deno:/app -w /app appwrite/env-deno-1.5:1.0.0 ls
docker run --rm --env DENO_DIR=./.appwrite -v $(pwd)/tests/resources/packages/deno:/app -w /app appwrite/env-deno-1.5:1.0.0 deno cache index.ts
docker run --rm -v $(pwd)/tests/resources/packages/deno:/app -w /app appwrite/env-deno-1.5:1.0.0 tar -zcvf code.tar.gz .

mv $(pwd)/tests/resources/packages/deno/code.tar.gz $(pwd)/tests/resources/deno.tar.gz

rm -r $(pwd)/tests/resources/packages/deno
