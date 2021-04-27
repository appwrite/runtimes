public class HelloWorld { 
    public static void main(String[ ] args) {
        System.out.println(System.getenv("APPWRITE_FUNCTION_ID"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_NAME"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_TAG"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_TRIGGER"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_ENV_NAME"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_ENV_VERSION"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_EVENT"));
        System.out.println(System.getenv("APPWRITE_FUNCTION_EVENT_DATA"));
    }
}