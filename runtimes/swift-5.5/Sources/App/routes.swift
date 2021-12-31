import Vapor
import Foundation

struct RequestValue: Codable {
    let path: String;
    let file: String;
    let env: [String: String];
    let headers: [String: String]?;
    let payload: String;
}

class RequestResponse {
    var data: String;
    private var error: Bool = false;
    private var isJson: Bool = false;
    
    init(data: String) {
        self.data = data
    }
}

extension RequestResponse {
    func send(data: String) -> RequestResponse {
        self.isJson = false;
        self.data = data;
        self.error = false;
        return self;
    }
    
    func json(data: [String: Any]) -> RequestResponse {
        if let JSONData = try?  JSONSerialization.data(
          withJSONObject: data,
          options: .prettyPrinted
          ),
          let JSONText = String(data: JSONData,
                                   encoding: String.Encoding.ascii) {
            self.error = false;
            self.data = JSONText;
            self.isJson = true;
        } else {
            self.error = true;
            self.data = "{'code': 500, 'message': 'Something went wrong encoding the Response JSON Object!'}";
            self.isJson = true;
        }
        return self;
    }
    
    func error(data: Error) -> RequestResponse {
        let jsonObject: NSMutableDictionary = NSMutableDictionary()
        jsonObject["code"] = 500
        jsonObject["message"] = data.localizedDescription
        
        do {
            let jsonData: NSData
            jsonData = try JSONSerialization.data(withJSONObject: jsonObject, options: JSONSerialization.WritingOptions()) as NSData
            let jsonString = NSString(data: jsonData as Data, encoding: String.Encoding.utf8.rawValue) as! String
            self.data = jsonString
        } catch _ {
            self.data = "{'code': 500, 'message': 'Something went wrong internally. Check the docker logs.'}";
        }
            
        self.error = true;
        self.isJson = true;
        return self;
    }
}

extension RequestResponse: ResponseEncodable {
    func encodeResponse(for request: Request) -> EventLoopFuture<Response> {
        var headers = HTTPHeaders()
        
        switch self.isJson {
        case false:
            headers.add(name: .contentType, value: "text/plain");
        case true:
            headers.add(name: .contentType, value: "application/json");
        }
        
        if self.error {
            return request.eventLoop.makeSucceededFuture(.init(
                status: .internalServerError, headers: headers, body: .init(string: self.data)
            ))
        }
        
        return request.eventLoop.makeSucceededFuture(.init(
            status: .ok, headers: headers, body: .init(string: self.data)
        ))
    }
}

func routes(_ app: Application) throws {
    app.on(.POST, "", body: .stream) { req -> RequestResponse in
        do {
            let requestData = Data(req.body.string!.utf8);
            let request = try JSONDecoder().decode(RequestValue.self, from: requestData);
            
            let userFunctionResponse = main(req: request, res: RequestResponse(data: ""));
            
            return userFunctionResponse;
        } catch let error {
            return RequestResponse(data: "").error(data: error);
        }
    }
}
