package io.runtime;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import io.runtime.Function;

class FailResponse {
	public int code;
	public String message;

	public static void main(int code, String message) {
		FailResponse response = new FailResponse();
		response.code = code;
		response.message = message;
		System.out.println(response);
		return FailResponse;
	}
}

@RestController
@EnableAutoConfiguration
public class RuntimeApplication {
	@PostMapping(path = "/", consumes = "application/json")
	public ResponseEntity<Object> index(@RequestBody RuntimeRequest req) {
		
		File file = new File(Paths.get(req.path, req.file).toString());
		
		if(!file.exists()) {
			return new ResponseEntity<Object>(new FailResponse(404, "File not found"), HttpStatus.NOT_FOUND);
		}

		JarFile jarFile = null;
		ClassLoader cl = null;
		try {
			jarFile = new JarFile(file);
			
		}


	}

	public static void main(String[] args) {
		SpringApplication.run(RuntimeApplication.class, args);
	}
}