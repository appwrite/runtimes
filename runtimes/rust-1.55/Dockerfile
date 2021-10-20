FROM rust:1.55-alpine

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

RUN mkdir -p /usr/local/src/
RUN mkdir -p /usr/code
RUN mkdir -p /usr/workspace
RUN mkdir -p /usr/builtCode

WORKDIR /usr/local/src
COPY . /usr/local/src

RUN apk add --no-cache musl-dev
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/builtCode"]

USER appwrite

CMD ["tail", "-f", "/dev/null"]