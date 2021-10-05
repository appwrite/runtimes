import 'package:shelf/shelf.dart';
import 'package:shelf/shelf_io.dart' as shelf_io;
import 'package:shelf_router/shelf_router.dart' as shelf_router;
import 'package:shelf_static/shelf_static.dart' as shelf_static;

Future main() async {

  final port = '3000';

  final cascade = Cascade()
    .add(runtimeHandler)


  final server = await shelf_io.serve(
    logRequests()
      .addHandler(cascade.handler),
    InternetAddress.anyIPv4,
    port
  )
}

Response runtimeHandler(Request request) {

}
  