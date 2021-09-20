package io.runtime;

public class RuntimeRequest {
    public String path;
    public String file;
    public Object env;
    public Object payload;
    public Object Headers;

    public RuntimeRequest(String path, String file, Object env, Object payload, Object Headers) {
        this.path = path;
        this.file = file;
        this.env = env;
        this.payload = payload;
        this.Headers = Headers;
    }
}