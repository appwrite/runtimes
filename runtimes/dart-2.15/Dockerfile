FROM dart:2.15

LABEL maintainer="team@appwrite.io"

RUN groupadd -g 2000 appwrite \
&& useradd -m -u 2001 -g appwrite appwrite

RUN mkdir -p /usr/local/src/
RUN mkdir -p /usr/code
RUN mkdir -p /usr/workspace
RUN mkdir -p /usr/builtCode

WORKDIR /usr/local/src
COPY . /usr/local/src

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/builtCode"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/lib/dart"]

USER appwrite

CMD ["tail", "-f", "/dev/null"]
