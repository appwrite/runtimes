<?php
$server = new Swoole\HTTP\Server("0.0.0.0", 3000);

function join_paths() {
    $paths = array();

    foreach (func_get_args() as $arg) {
        if ($arg !== '') { $paths[] = $arg; }
    }

    return preg_replace('#/+#','/',join('/', $paths));
}

class Response {
    function __construct($res) {
        $this->res = $res;
    }

    function send($text, $status = 200) {
        $this->res->status($status);
        $this->res->end($text);
    }

    function json($json, $status = 200) {
        $this->res->status($status);
        $this->res->headers['Content-Type'] = 'application/json';
        $this->res->end(json_encode($json));
    }
}


$server->on("Request", function($req, $res) {
    $body =  json_decode($req->getContent(), true);

    $request = new stdClass();

    $request->env = $body['env'] ?? [];
    $request->headers = $body['headers'] ?? [];
    $request->payload = $body['payload'] ?? [];

    $response = new Response($res);

    try {
        $userFunction = require(join_paths($body['path'], $body['file']));

        if (!is_callable($userFunction)) {
            return throw new Exception('Function not valid');
        }
        $userFunction($request, $response);
    } catch (Exception $e) {
        $res->status($status);
        $res->end(json_encode([
            'code' => 500,
            'message' => $e->getMessage()
        ]));
    }
});

$server->start();