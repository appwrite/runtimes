FROM python:3.9.7-alpine3.13

RUN addgroup -S appwrite -g 2000 && adduser -S appwrite -G appwrite -D -u 2001

RUN mkdir -p /usr/local/src/
RUN mkdir -p /usr/code
RUN mkdir -p /usr/workspace
RUN mkdir -p /usr/builtCode

WORKDIR /usr/local/src/
COPY . .

ENV FLASK_APP="/usr/local/src/server.py"

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/local/src"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/code"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/workspace"]
RUN ["chown", "-R", "appwrite:appwrite", "/usr/builtCode"]

USER appwrite

CMD [ "/usr/local/src/launch.sh" ]
