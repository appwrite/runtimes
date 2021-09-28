FROM python:3.9.7-alpine3.13

WORKDIR /usr/local/src
COPY requirements.txt /usr/local/src/

ENV PIP_TARGET="/usr/src/code/.appwrite"

RUN pip install --no-cache-dir -r requirements.txt

WORKDIR /usr/src/code

# Add Source Code
COPY ./server.py /usr/src/code/server.py

ENV FLASK_APP="/usr/src/code/server.py"

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]

CMD [ "/usr/src/code/launch.sh" ]
