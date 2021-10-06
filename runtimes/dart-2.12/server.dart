import 'dart:convert';
import 'package:shelf/shelf.dart' as shelf;
import 'package:shelf/shelf_io.dart' as shelf_io;
import 'user_code/main.dart' as user_code;
import 'package:appwrite_function_types/appwrite_function_types.dart';

void main(List<String> arguments) async {
  await shelf_io.serve((req) async {
    if (req.method != 'POST') {
      return shelf.Response(500, body: 'Invalid request');
    }
    try {
      final bodystring = await req.readAsString();
      final body = jsonDecode(bodystring);
      final request = Request(
        env: body['env'] ?? {},
        headers: body['headers'] ?? {},
        payload: body['payload'] ?? {},
      );

      final response = Response();
      await user_code.start(request, response);
      return shelf.Response.ok(response.body);
    } on FormatException catch (_) {
      return shelf.Response(500, body: 'Unable to properly load request body');
    } catch (e) {
      return shelf.Response(500, body: e);
    }
  }, '0.0.0.0', 3000);
}
