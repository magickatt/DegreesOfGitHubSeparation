#!/usr/bin/env bash

locale-gen en_GB.UTF-8

wget -O - https://debian.neo4j.org/neotechnology.gpg.key | apt-key add -
echo 'deb http://debian.neo4j.org/repos stable/' > /tmp/neo4j.list
mv /tmp/neo4j.list /etc/apt/sources.list.d

add-apt-repository ppa:ondrej/php
add-apt-repository ppa:openjdk-r/ppa
apt-get update
apt-get upgrade
apt-get install software-properties-common -y
apt-get install apache2 -y
apt-get install php5.6 -y
apt-get install php5.6-xml -y
apt-get install php5.6-bcmath -y
apt-get install php5.6-mbstring -y
apt-get install php5.6-curl -y
apt-get install openjdk-8-jdk -y
apt-get install neo4j -y
apt-get install zip -y
apt-get install git -y

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

usermod -a -G www-data vagrant
usermod -a -G vagrant www-data