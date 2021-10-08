FROM ruby:3.0.2-alpine3.13

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/local/src/

WORKDIR /usr/local/src/

RUN apk add --update alpine-sdk

RUN gem install bundler

COPY . .

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
CMD [ "/usr/local/src/launch.sh" ]