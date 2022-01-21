# Python Runtime 3.10
A runtime container for Python 3.10
Developed to easily run and build Python Code within a container.

## Creating a function for the runtime
To create a function for the runtime, your function **must** be named `main`. It must take two parameters, `Request` and `Response` in that order. what you can expect these types to contain can be found below in the `Types` section.

## Handling User Dependencies
In order to install dependencies for Python code you only need to add your `requirements.txt` file and the build stage will automatically fetch the dependencies for you. 

## Types

Types can be found [here.](function_types)

You can also import them into your IDE, simply run this pip install command:
```bash
pip install git+https://github.com/appwrite/function-types.git/python/
```

## Running the runtime manually without an executor
Running the runtime without an executor is possible by following the steps below.

### 1. Building the image

The Docker image for this runtime must be built before it can be used.

Within the directory of the runtime you must run the following command:
```bash
docker build -t python-runtime:3.10 .
```

### 2. Building the Code

You can run the following command to build the code in the directory where your code is located:
```bash
docker run -it --rm -v $(pwd):/usr/code/ -e ENTRYPOINT_NAME=YourPythonFileName.py python-runtime:3.10 /usr/local/src/build.sh
```

Make sure to replace `YourPythonFileName.py` with the name of your file.

After running the command if it's successful you should now have a `runtime-env` folder.
This is a cached version of all the dependencies that were installed for your code and the runtime itself.

Next you want to tarball the `runtime-env` folder and your code. You can run the following command:
```bash
tar -czvf ./code.tar.gz ./
```
This should create a file called `code.tar.gz` which can be used for running the code on the runtime.

### 3. Running the Code Server

With the `code.tar.gz` file you can now run the following command to launch the runtime on port 3000:
```bash
docker run -it -p 3000:3000 -e INTERNAL_RUNTIME_KEY=TheRuntimeKeyYouWant --rm -v $(pwd)/code.tar.gz:/tmp/code.tar.gz python-runtime:3.10 /usr/local/src/launch.sh
```
This launches the runtime server and allows you to now make requests to the runtime. You can also run the following command to launch the runtime in a detached mode:
```bash
docker run -d -p 3000:3000 -e INTERNAL_RUNTIME_KEY=TheRuntimeKeyYouWant --rm -v $(pwd)/code.tar.gz:/tmp/code.tar.gz python-runtime:3.10 /usr/local/src/launch.sh
```

Keep note of the `INTERNAL_RUNTIME_KEY`. This is a security precaution to ensure that only you or the executor which brought up the runtime can access it.

### 4. Making a Request to Execute the Code

To make a request to the runtime you can use your favorite HTTP client.

You have to send a `POST` request to `localhost:3000` with the following JSON body:
```json
{
    "file": "index.py",
    "path": "/usr/code",
    "env": {
    },
    "timeout": 60,
    "payload": "", 
    "headers": {
    }
}
```
The header `x-internal-challenge` must be set to the value of the `INTERNAL_RUNTIME_KEY` environment variable.
`file` is the name of the file you want to execute.
`path` is the path to the directory where the code is located. Normally `/usr/code`

`env` is a map of environment variables that will be set when the code is executed. This is available to the user code through the `Request` class.
`timeout` is the amount of time in seconds that the code will be allowed to run before it is killed. This is currently not used in most runtimes due to alot of languages don't allow killing asyncronous functions.
`payload` is the payload that will be sent to the code. This is available to the user code through the `Request` class.
`headers` is a map of headers that will be sent to the code. This is available to the user code through the `Request` class.

If execution is successful you'll get a response of whatever your code returns using the `Response` class.

## Footguns to note
 - None of note.

## Example Code

```python
def main(req, res):
    return res.json({'Hello': 'World!'})
```

## Credits
**Bradley Schofield**
 - [GitHub](https://github.com/PineappleIOnic/)