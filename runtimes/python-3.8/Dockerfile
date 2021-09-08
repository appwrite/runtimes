FROM python:3.8.12-alpine3.13

workdir /usr/local/src
COPY requirements.txt /usr/local/src/

RUN pip install --no-cache-dir -r requirements.txt

WORKDIR /usr/src/code

# Add Source Code
COPY ./server.py /usr/src/code/server.py

ENV FLASK_APP="/usr/src/code/server.py"

EXPOSE 3000

CMD [ "flask", "run", "--host=0.0.0.0", "--port=3000"]