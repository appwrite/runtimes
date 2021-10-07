echo '.NET 5.0 Packaging...'

rm $(pwd)/tests/resources/dotnet-5.0.tar.gz
tar -zcvf $(pwd)/tests/resources/dotnet-5.0.tar.gz -C $(pwd)/tests/resources/dotnet-5.0 .