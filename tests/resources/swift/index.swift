//
//  File.swift
//  
//
//  Created by Bradley Schofield on 21/12/2021.
//

import Foundation

func main(req: RequestValue, res: RequestResponse) -> RequestResponse {
    return res.json(data: [
        "normal": "Hello World!",
        "env1": req.env["ENV1"],
        "payload": req.payload,
    ]);
}
