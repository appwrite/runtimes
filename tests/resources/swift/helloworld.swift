import Foundation

if let funcId = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_ID"] {
    print(funcId);
}
if let funcName = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_NAME"] {
    print(funcName);
}
if let funcTag = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_TAG"] {
    print(funcTag);
}
if let funcTrigger = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_TRIGGER"] {
    print(funcTrigger);
}
if let funcEnvName = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_ENV_NAME"] {
    print(funcEnvName);
}
if let funcEnvVersion = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_ENV_VERSION"] {
    print(funcEnvVersion);
}
if let funcEvent = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_EVENT"] {
    print(funcEvent);
}
if let funcEventData = ProcessInfo.processInfo.environment["APPWRITE_FUNCTION_EVENT_DATA"] {
    print(funcEventData);
}