echo '.NET 3.1 Packaging...'

rm $(pwd)/tests/resources/dotnet-3.1.tar.gz
tar -zcvf $(pwd)/tests/resources/dotnet-3.1.tar.gz -C $(pwd)/tests/resources/dotnet-3.1 .