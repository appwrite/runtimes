FROM rust:1.55-alpine

WORKDIR /usr/local/src
COPY . /usr/local/src

RUN apk add --no-cache musl-dev
RUN chmod +x ./build.sh

CMD ["tail", "-f", "/dev/null"]