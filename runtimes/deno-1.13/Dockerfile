FROM denoland/deno:alpine-1.13.2

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app

RUN deno install -qAf --unstable https://deno.land/x/denon/denon.ts

COPY . .

CMD ["denon", "run", "--allow-net", "--allow-read", "app.ts"]

EXPOSE 3000