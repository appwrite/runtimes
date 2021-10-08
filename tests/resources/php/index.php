<?php

return function ($request, $response) {
    $response->json([
        'normal' => 'Hello World!',
        'env1' => $request->env['ENV1'],
        'payload' => $request->payload
    ]);
};
