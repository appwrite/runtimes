FROM node:16-alpine

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/local/src

RUN apk add --no-cache rsync

WORKDIR /usr/local/src

COPY package* /usr/local/src/

RUN npm install pm2 -g

RUN npm ci && npm cache clean --force

COPY . .

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
CMD ["/usr/local/src/launch.sh"]

EXPOSE 3000