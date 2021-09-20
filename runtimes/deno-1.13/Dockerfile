FROM denoland/deno:alpine-1.13.2

LABEL maintainer="team@appwrite.io"

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app

RUN deno install -qAf --unstable https://deno.land/x/denon/denon.ts

COPY . .

EXPOSE 3000

RUN ["chmod", "+x", "./launch.sh"]
CMD ["./launch.sh"]