FROM composer:2.0 as step0

ARG TESTING=false
ENV TESTING=$TESTING

WORKDIR /usr/local/src/

COPY composer.lock /usr/local/src/
COPY composer.json /usr/local/src/

RUN composer install --ignore-platform-reqs --optimize-autoloader --no-plugins --no-scripts --prefer-dist

FROM php:8.0.14-cli-alpine as final

LABEL maintainer="team@appwrite.io"


WORKDIR /usr/src/code

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "memory_limit=1024M" >> $PHP_INI_DIR/php.ini

COPY --from=step0 /usr/local/src/vendor /usr/src/code/vendor

# Add Source Code
COPY . /usr/src/code

CMD [ "tail", "-f", "/dev/null" ]
