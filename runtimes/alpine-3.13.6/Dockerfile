FROM alpine:3.13.6

WORKDIR /usr/local/src/

COPY ./launch.sh /usr/local/src/

RUN [ "chmod", "+x", "/usr/local/src/launch.sh" ]

EXPOSE 3000

CMD ["/usr/local/src/launch.sh"]