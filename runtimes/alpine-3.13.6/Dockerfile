FROM alpine:3.13.6

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

WORKDIR /usr/local/src/

COPY ./launch.sh /usr/local/src/

RUN [ "chmod", "+x", "/usr/local/src/launch.sh" ]

RUN ["mkdir", "-p", "/usr/workspace"]
RUN ["mkdir", "-p", "/usr/code"]

RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]

USER appwrite

EXPOSE 3000

CMD ["/usr/local/src/launch.sh"]