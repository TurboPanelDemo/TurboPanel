# syntax=docker/dockerfile:1

FROM ubuntu:22.04 AS production

RUN apt-get update && apt-get install -yq wget
RUN ls -la
RUN wget https://raw.githubusercontent.com/TurboPanelDemo/TurboPanel/main/installers/install.sh -O turbo-install.sh
RUN chmod +x turbo-install.sh
RUN ./turbo-install.sh

COPY entrypoint.sh /usr/local/turbo/entrypoint.sh

ENTRYPOINT ["sh","/usr/local/turbo/entrypoint.sh"]
