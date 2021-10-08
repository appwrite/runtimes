def main(request, response)
    return response.json({
        :normal => "Hello World!",
        :payload => request.payload,
        :env1 => request.env['ENV1'],
    })
end