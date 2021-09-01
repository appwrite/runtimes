FROM composer:2.0 as step0
WORKDIR /usr/local/src/

COPY composer* /usr/local/src/

RUN composer update --ignore-platform-reqs --optimize-autoloader \
    --no-plugins --no-scripts --prefer-dist \
    `if [ "$TESTING" != "true" ]; then echo "--no-dev"; fi`

FROM php:8.0-cli-alpine as step1

ARG DEBUG=false
ENV DEBUG=$DEBUG

ENV PHP_SWOOLE_VERSION=v4.7.0

RUN \
  apk add --no-cache --virtual .deps \
  make \
  automake \
  autoconf \
  gcc \
  g++ \
  git \
  zlib-dev \
  brotli-dev \
  yaml-dev \
  libmaxminddb-dev

RUN docker-php-ext-install sockets

RUN \
  ## Swoole Extension
  git clone --depth 1 --branch $PHP_SWOOLE_VERSION https://github.com/swoole/swoole-src.git && \
  cd swoole-src && \
  phpize && \
  ./configure --enable-http2 && \
  make && make install && \
  cd ..

FROM php:8.0-cli-alpine as final

LABEL maintainer="team@appwrite.io"

RUN \
  apk update \
  && apk add --no-cache --virtual .deps \
  make \
  automake \
  autoconf \
  gcc \
  g++ \
  curl-dev \
  && apk add --no-cache \
  libstdc++ \
  certbot \
  brotli-dev \
  yaml-dev \
  libmaxminddb-dev \
  libgomp \
  && docker-php-ext-install opcache \
  && apk del .deps \
  && rm -rf /var/cache/apk/*

WORKDIR /usr/src/code

COPY --from=step0 /usr/local/src/vendor /usr/src/code/vendor
COPY --from=step1 /usr/local/lib/php/extensions/no-debug-non-zts-20200930/swoole.so /usr/local/lib/php/extensions/no-debug-non-zts-20200930/yasd.so* /usr/local/lib/php/extensions/no-debug-non-zts-20200930/

# Add Source Code
COPY ./http.php /usr/src/code/http.php

# Enable Extensions
RUN echo extension=swoole.so >> /usr/local/etc/php/conf.d/swoole.ini

EXPOSE 3000

CMD [ "php", "http.php" ]
