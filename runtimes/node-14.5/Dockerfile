FROM node:14.5-alpine

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app

COPY package* /usr/src/app/

RUN npm install pm2 -g

RUN npm ci && npm cache clean --force

COPY . .

RUN ["chmod", "+x", "./launch.sh"]
CMD ["./launch.sh"]

EXPOSE 3000