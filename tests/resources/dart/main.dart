import 'dart:async';
import 'package:appwrite_function_types/appwrite_function_types.dart';

Future<void> start(Request request, Response response) async {
  response.json({
    'normal': 'Hello World!',
    'env1': request.env['ENV1'],
    'payload': request.payload,
  });
}