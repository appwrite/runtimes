FROM denoland/deno:alpine-1.12.2

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/local/src/

WORKDIR /usr/local/src/

ENV DENO_DIR=/usr/code/denoCache

RUN deno install -qAf --unstable https://deno.land/x/denon/denon.ts

COPY . .

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
CMD [ "/usr/local/src/launch.sh" ]