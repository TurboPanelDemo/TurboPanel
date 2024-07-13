#!/bin/bash

wget https://github.com/TurboPanelDemo/TurboPanelWebCompiledVersions/raw/main/turbo-web-panel.zip
unzip -qq -o turbo-web-panel.zip -d /usr/local/turbo/web
rm -rf turbo-web-panel.zip

chmod 711 /home
chmod -R 750 /usr/local/turbo
