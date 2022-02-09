import 'dart:async';

Future<void> start(final request, final response) async {
  response.json({
    'normal': 'Hello World!',
    'env1': request.env['ENV1'],
    'payload': request.payload,
  });
}