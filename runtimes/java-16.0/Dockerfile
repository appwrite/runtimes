# BUILD IMAGE, NOT A RUNTIME IMAGE!

FROM openjdk:16-jdk-alpine3.13

WORKDIR /usr/local/src
COPY . /usr/local/src/

#TODO: Copy user code.

CMD ["gradlew", "build"]