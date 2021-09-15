FROM openjdk:16-jdk-alpine3.13

WORKDIR /usr/local/src
COPY . /usr/local/src/

RUN ./gradlew build --refresh-dependencies

WORKDIR /usr/src/code
COPY . /usr/src/code/

CMD ["tail", "-f", "/dev/null"]