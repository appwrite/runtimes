FROM ubuntu:20.04

WORKDIR /usr/local/src/

RUN groupadd -g 2000 appwrite \
&& useradd -m -u 2001 -g appwrite appwrite

COPY ./launch.sh /usr/local/src/

RUN [ "chmod", "+x", "/usr/local/src/launch.sh" ]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]

EXPOSE 3000

USER appwrite

CMD ["/usr/local/src/launch.sh"]