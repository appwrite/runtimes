FROM dart:2.12

LABEL maintainer="team@appwrite.io"

WORKDIR /usr/local/src
COPY . /usr/local/src

RUN chmod +x ./build.sh
RUN chmod +x ./launch.sh

CMD ["tail", "-f", "/dev/null"]