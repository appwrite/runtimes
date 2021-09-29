FROM julia:1.6.3-alpine3.14

# Add Source Code
COPY ./server.jl /usr/local/src/
COPY ./launch.sh /usr/local/src/
COPY ./build.sh /usr/local/src/

EXPOSE 3000

RUN ["chmod", "+x", "/usr/local/src/launch.sh"]
RUN ["chmod", "+x", "/usr/local/src/build.sh"]

CMD [ "/usr/local/src/launch.sh" ]
