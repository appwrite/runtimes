FROM alpine:3.13.6

WORKDIR /usr

COPY ./run.sh /usr/

RUN [ "chmod", "+x", "/usr/run.sh" ]

EXPOSE 3000

CMD ["/usr/run.sh"]