rm -rf /usr/local/turbo/update/web-panel-latest
rm -rf /usr/local/turbo/update/turbo-web-panel.zip

wget https://github.com/TurboPanelDemo/TurboPanelWebCompiledVersions/raw/main/turbo-web-panel.zip
ls -la
unzip -o turbo-web-panel.zip -d /usr/local/turbo/update/web-panel-latest

rm -rf /usr/local/turbo/web/vendor
rm -rf /usr/local/turbo/web/composer.lock
rm -rf /usr/local/turbo/web/routes
rm -rf /usr/local/turbo/web/public
rm -rf /usr/local/turbo/web/resources
rm -rf /usr/local/turbo/web/database
rm -rf /usr/local/turbo/web/config
rm -rf /usr/local/turbo/web/app
rm -rf /usr/local/turbo/web/bootstrap
rm -rf /usr/local/turbo/web/lang
rm -rf /usr/local/turbo/web/Modules
rm -rf /usr/local/turbo/web/thirdparty

cp -r /usr/local/turbo/update/web-panel-latest/vendor /usr/local/turbo/web/vendor
cp /usr/local/turbo/update/web-panel-latest/composer.lock /usr/local/turbo/web/composer.lock
cp -r /usr/local/turbo/update/web-panel-latest/routes /usr/local/turbo/web/routes
cp -r /usr/local/turbo/update/web-panel-latest/public /usr/local/turbo/web/public
cp -r /usr/local/turbo/update/web-panel-latest/resources /usr/local/turbo/web/resources
cp -r /usr/local/turbo/update/web-panel-latest/database /usr/local/turbo/web/database
cp -r /usr/local/turbo/update/web-panel-latest/config /usr/local/turbo/web/config
cp -r /usr/local/turbo/update/web-panel-latest/app /usr/local/turbo/web/app
cp -r /usr/local/turbo/update/web-panel-latest/bootstrap /usr/local/turbo/web/bootstrap
cp -r /usr/local/turbo/update/web-panel-latest/lang /usr/local/turbo/web/lang
cp -r /usr/local/turbo/update/web-panel-latest/Modules /usr/local/turbo/web/Modules
#cp -r /usr/local/turbo/update/web-panel-latest/thirdparty /usr/local/turbo/web/thirdparty

cp -r /usr/local/turbo/update/web-panel-latest/db-migrate.sh /usr/local/turbo/web/db-migrate.sh
chmod +x /usr/local/turbo/web/db-migrate.sh
#
cd /usr/local/turbo/web
#
#
#
#TURBO_PHP=/usr/local/turbo/php/bin/php
##
#$TURBO_PHP -v
#$TURBO_PHP -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#$TURBO_PHP ./composer-setup.php
#$TURBO_PHP -r "unlink('composer-setup.php');"

#rm -rf composer.lock
#COMPOSER_ALLOW_SUPERUSER=1 $TURBO_PHP composer.phar i --no-interaction --no-progress
#COMPOSER_ALLOW_SUPERUSER=1 $TURBO_PHP composer.phar dump-autoload --no-interaction

./db-migrate.sh

service turbo restart
