import App
import Vapor

var env = try Environment.detect()
try LoggingSystem.bootstrap(from: &env)
let app = Application(env)
defer { app.shutdown() }
try configure(app)
app.http.server.configuration.port = 3000
app.http.server.configuration.hostname = "0.0.0.0"
try app.run()
