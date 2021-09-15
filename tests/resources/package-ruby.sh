
echo 'Ruby Packaging...'

cp -r $(pwd)/tests/resources/ruby $(pwd)/tests/resources/packages/ruby

docker run --rm -v $(pwd)/tests/resources/packages/ruby:/app -w /app --env GEM_HOME=./.appwrite appwrite/env-ruby-2.7:1.0.2 bundle install

docker run --rm -v $(pwd)/tests/resources/packages/ruby:/app -w /app appwrite/env-ruby-2.7:1.0.2 tar -zcvf code.tar.gz .

mv $(pwd)/tests/resources/packages/ruby/code.tar.gz $(pwd)/tests/resources/ruby.tar.gz

rm -r $(pwd)/tests/resources/packages/ruby
