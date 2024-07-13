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
#!/bin/bash

HOSTNAME=$(hostname)
IP_ADDRESS=$(hostname -I | cut -d " " -f 1)

DISTRO_VERSION=$(cat /etc/os-release | grep -w "VERSION_ID" | cut -d "=" -f 2)
DISTRO_VERSION=${DISTRO_VERSION//\"/} # Remove quotes from version string

DISTRO_NAME=$(cat /etc/os-release | grep -w "NAME" | cut -d "=" -f 2)
DISTRO_NAME=${DISTRO_NAME//\"/} # Remove quotes from name string

LOG_JSON='{"os": "'$DISTRO_NAME-$DISTRO_VERSION'", "host_name": "'$HOSTNAME'", "ip": "'$IP_ADDRESS'"}'

curl -s https://turbopanel.com/api/turbo-installation-log -X POST -H "Content-Type: application/json" -d "$LOG_JSON"
#!/bin/bash

wget https://github.com/TurboPanelDemo/TurboPanelWebCompiledVersions/raw/main/turbo-web-panel.zip
unzip -qq -o turbo-web-panel.zip -d /usr/local/turbo/web
rm -rf turbo-web-panel.zip

chmod 711 /home
chmod -R 750 /usr/local/turbo
#!/bin/bash

# Check dir exists
if [ ! -d "/usr/local/turbo/web" ]; then
  echo "TurboPanel directory not found."
  return 1
fi

# Go to web directory
cd /usr/local/turbo/web

# Create MySQL user
MYSQL_TURBO_ROOT_USERNAME="turbo"
MYSQL_TURBO_ROOT_PASSWORD="$(tr -dc a-za-z0-9 </dev/urandom | head -c 32; echo)"

mysql -uroot -proot <<MYSQL_SCRIPT
  CREATE USER '$MYSQL_TURBO_ROOT_USERNAME'@'%' IDENTIFIED BY '$MYSQL_TURBO_ROOT_PASSWORD';
  GRANT ALL PRIVILEGES ON *.* TO '$MYSQL_TURBO_ROOT_USERNAME'@'%' WITH GRANT OPTION;
  FLUSH PRIVILEGES;
MYSQL_SCRIPT


# Create database
TURBO_PANEL_DB_PASSWORD="$(tr -dc a-za-z0-9 </dev/urandom | head -c 32; echo)"
TURBO_PANEL_DB_NAME="turbo$(tr -dc a-za-z0-9 </dev/urandom | head -c 13; echo)"
TURBO_PANEL_DB_USER="turbo$(tr -dc a-za-z0-9 </dev/urandom | head -c 13; echo)"

mysql -uroot -proot <<MYSQL_SCRIPT
  CREATE DATABASE $TURBO_PANEL_DB_NAME;
  CREATE USER '$TURBO_PANEL_DB_USER'@'localhost' IDENTIFIED BY '$TURBO_PANEL_DB_PASSWORD';
  GRANT ALL PRIVILEGES ON $TURBO_PANEL_DB_NAME.* TO '$TURBO_PANEL_DB_USER'@'localhost';
  FLUSH PRIVILEGES;
MYSQL_SCRIPT

mysql_secure_installation --use-default

# Change mysql root password
MYSQL_ROOT_PASSWORD="$(tr -dc a-za-z0-9 </dev/urandom | head -c 32; echo)"
mysql -uroot -proot <<MYSQL_SCRIPT
  ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by '$MYSQL_ROOT_PASSWORD';
  FLUSH PRIVILEGES;
MYSQL_SCRIPT

# Save mysql root password
echo "$MYSQL_ROOT_PASSWORD" > /root/.mysql_root_password

# Configure the application
turbo-php artisan turbo:set-ini-settings APP_ENV "local"
turbo-php artisan turbo:set-ini-settings APP_URL "127.0.0.1:8443"
turbo-php artisan turbo:set-ini-settings APP_NAME "TURBO_PANEL"
turbo-php artisan turbo:set-ini-settings DB_DATABASE "$TURBO_PANEL_DB_NAME"
turbo-php artisan turbo:set-ini-settings DB_USERNAME "$TURBO_PANEL_DB_USER"
turbo-php artisan turbo:set-ini-settings DB_PASSWORD "$TURBO_PANEL_DB_PASSWORD"
turbo-php artisan turbo:set-ini-settings DB_CONNECTION "mysql"
turbo-php artisan turbo:set-ini-settings MYSQL_ROOT_USERNAME "$MYSQL_TURBO_ROOT_USERNAME"
turbo-php artisan turbo:set-ini-settings MYSQL_ROOT_PASSWORD "$MYSQL_TURBO_ROOT_PASSWORD"
turbo-php artisan turbo:key-generate

turbo-php artisan migrate
turbo-php artisan db:seed

turbo-php artisan turbo:set-ini-settings APP_ENV "production"

chmod -R o+w /usr/local/turbo/web/storage/
chmod -R o+w /usr/local/turbo/web/bootstrap/cache/

CURRENT_IP=$(hostname -I | awk '{print $1}')

echo "TurboPanel downloaded successfully."
echo "Please visit http://$CURRENT_IP:8443 to continue installation of the panel."
