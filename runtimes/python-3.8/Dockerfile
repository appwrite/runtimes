FROM python:3.8.12-alpine3.13

WORKDIR /usr/local/src/
COPY . .

ENV FLASK_APP="/usr/local/src/server.py"

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]

CMD [ "/usr/local/src/launch.sh" ]
