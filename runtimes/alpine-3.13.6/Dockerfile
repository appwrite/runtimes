FROM alpine:3.13.6

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

WORKDIR /usr/local/src/

COPY ./launch.sh /usr/local/src/

RUN [ "chmod", "+x", "/usr/local/src/launch.sh" ]

RUN ["chown", "-R", "appwrite:appwrite", "/usr"]

USER appwrite

EXPOSE 3000

CMD ["/usr/local/src/launch.sh"]