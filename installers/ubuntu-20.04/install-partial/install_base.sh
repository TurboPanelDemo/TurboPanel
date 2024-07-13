#!/bin/bash

INSTALL_DIR="/turbo/install"

apt-get update && apt-get install ca-certificates

mkdir -p $INSTALL_DIR

cd $INSTALL_DIR

DEPENDENCIES_LIST=(
    "openssl"
    "jq"
    "curl"
    "wget"
    "unzip"
    "zip"
    "tar"
    "mysql-common"
    "mysql-server"
    "mysql-client"
    "lsb-release"
    "gnupg2"
    "ca-certificates"
    "apt-transport-https"
    "software-properties-common"
    "supervisor"
    "libonig-dev"
    "libzip-dev"
    "libcurl4-openssl-dev"
    "libsodium23"
    "libpq5"
    "libssl-dev"
    "zlib1g-dev"
)
# Check if the dependencies are installed
for DEPENDENCY in "${DEPENDENCIES_LIST[@]}"; do
    apt install -yq $DEPENDENCY
done

# Start MySQL
service mysql start

wget https://raw.githubusercontent.com/TurboPanelDemo/TurboPanel/main/installers/ubuntu-20.04/greeting.sh
mv greeting.sh /etc/profile.d/turbo-greeting.sh

# Install TURBO PHP
wget php: https://github.com/TurboPanelDemo/TurboPanelPHP/raw/main/compilators/debian/php/dist/turbo-php-8.2.0-ubuntu-20.04.deb
dpkg -i turbo-php-8.2.0-ubuntu-20.04.deb

# Install TURBO NGINX
wget https://github.com/TurboPanelDemo/TurboPanelNGINX/raw/main/compilators/debian/nginx/dist/turbo-nginx-1.24.0-ubuntu-20.04.deb
dpkg -i turbo-nginx-1.24.0-ubuntu-20.04.deb

service turbo start

TURBO_PHP=/usr/local/turbo/php/bin/php

ln -s $TURBO_PHP /usr/bin/turbo-php
