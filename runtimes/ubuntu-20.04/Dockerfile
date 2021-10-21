FROM ubuntu:20.04

WORKDIR /usr/local/src/

RUN groupadd -g 2000 appwrite \
&& useradd -m -u 2001 -g appwrite appwrite

COPY ./launch.sh /usr/local/src/

RUN [ "chmod", "+x", "/usr/local/src/launch.sh" ]
RUN ["mkdir", "-p", "/usr/workspace"]
RUN ["mkdir", "-p", "/usr/code"]

RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]

EXPOSE 3000

USER appwrite

CMD ["/usr/local/src/launch.sh"]