fun main() {
    println(System.getenv("APPWRITE_FUNCTION_ID") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_NAME") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_TAG") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_TRIGGER") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_ENV_NAME") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_ENV_VERSION") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_EVENT") ?: "");
    println(System.getenv("APPWRITE_FUNCTION_EVENT_DATA") ?: "");
}