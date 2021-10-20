FROM node:14.5-alpine

LABEL maintainer="team@appwrite.io"

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

RUN mkdir -p /usr/local/src/
RUN mkdir -p /usr/code
RUN mkdir -p /usr/workspace
RUN mkdir -p /usr/builtCode

WORKDIR /usr/local/src

RUN apk add --no-cache rsync

COPY package* /usr/local/src/

RUN npm install pm2 -g

RUN npm ci && npm cache clean --force

COPY . .

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/builtCode"]

USER appwrite

EXPOSE 3000

CMD ["/usr/local/src/launch.sh"]