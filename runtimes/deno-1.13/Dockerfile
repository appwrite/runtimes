FROM denoland/deno:alpine-1.13.2

LABEL maintainer="team@appwrite.io"

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

RUN mkdir -p /usr/local/src/
RUN mkdir -p /usr/code
RUN mkdir -p /usr/workspace

WORKDIR /usr/local/src/

ENV DENO_DIR=/usr/code/denoCache

RUN deno install -qAf --unstable https://deno.land/x/denon@2.4.8/denon.ts

COPY . .

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]

USER appwrite

EXPOSE 3000

CMD [ "/usr/local/src/launch.sh" ]