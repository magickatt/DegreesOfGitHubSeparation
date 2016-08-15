#!/usr/bin/env bash

apt-get update
apt-get install php5 -y
apt-get install apache2 -y

# Configure Apache
echo "ServerName localhost" > /etc/apache2/conf-enabled/servername.conf
a2dissite 000-default.conf
cp /tmp/separation.conf /etc/apache2/sites-available
a2ensite separation.conf
a2enmod headers
a2enmod rewrite
a2enmod expires
service apache2 restart
usermod -a -G www-data vagrant

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer