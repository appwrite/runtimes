import Pkg
Pkg.add("HTTP")
Pkg.add("JSON")
using HTTP
using JSON

class

HTTP.listen("0.0.0.0", 3000) do http::HTTP.Stream
    bodyString = ""
    while !eof(http)
        bodyString = String(readavailable(http))
    end
    body = JSON.parse(bodyString)

    # Check all the data we need is here.
    if haskey(body, "path") && haskey(body, "file")
        path = body["path"]
        file = body["file"]

        # Check if file is accessible
        if isfile(path * "/" * file)
            # Require the requested file
            require(path * "/" * file)
            # Execute main function in file
            UserFunction.main()
        else
            
        end
    end
    HTTP.setstatus(http, 404)
    HTTP.setheader(http, "Foo-Header" => "bar")
    HTTP.startwrite(http)
    write(http, "response body")
    write(http, "more response body")
end