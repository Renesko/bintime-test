#!/bin/sh

server="bintime-test"
home=/var/www/$server/vagrant
config=$home/config

#set locale
cp -rf $config/locale /etc/default/locale

#set bash aliases
cp -rf $config/.bash_aliases .

#Linux Utilities Install
apt-get update -y
apt-get install vim nginx curl mc git htop -y

#install libaio
apt-get install libaio1 libaio-dev

#install php
apt-get install php7.0-cli php7.0-fpm php7.0-pgsql php7.0-mbstring php7.0-xml php7.0-curl php7.0-dev php-pear php7.0-bcmath php-xdebug -y

#Install Composer globaly
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod 777 /usr/local/bin/composer

#Nginx
cp -rf $config/$server.conf /etc/nginx/sites-available/$server.conf
ln -s /etc/nginx/sites-available/$server.conf /etc/nginx/sites-enabled/$server.conf

#disable hugepages (cause mongo command line warning)
cp -rf $config/rc.local /etc/rc.local

#install MongoDB
apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv EA312927
echo "deb http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.2 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.2.list
apt-get update

apt-get install -y mongodb-org

cp -rf $config/mongodb.service /etc/systemd/system/mongodb.service

systemctl start mongodb
systemctl enable mongodb

#install MongoDB PHP extension
apt-get install pkg-config
apt-get install libssl-dev

pecl install mongodb

echo "extension=mongodb.so" | tee -a /etc/php/7.0/mods-available/mongodb.ini

phpenmod mongodb

#install java for Elastic
apt-get install -y python-software-properties software-properties-common apt-transport-https
add-apt-repository ppa:webupd8team/java -y
apt-get update

echo debconf shared/accepted-oracle-license-v1-1 select true | debconf-set-selections
echo debconf shared/accepted-oracle-license-v1-1 seen true | debconf-set-selections
apt-get install -y oracle-java8-installer

#install and configure Elastic
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | apt-key add -
echo "deb https://artifacts.elastic.co/packages/5.x/apt stable main" | tee -a /etc/apt/sources.list.d/elastic-5.x.list
apt-get update

apt-get install -y elasticsearch

cp -rf $config/elasticsearch.yml /etc/elasticsearch/elasticsearch.yml
cp -rf $config/elasticsearch.service /usr/lib/systemd/system/elasticsearch.service
cp -rf $config/elasticsearch /etc/default/elasticsearch

systemctl daemon-reload
systemctl enable elasticsearch
systemctl start elasticsearch

#install RabbitMQ
echo 'deb http://www.rabbitmq.com/debian/ testing main' | tee /etc/apt/sources.list.d/rabbitmq.list
wget -O- https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | apt-key add -
apt-get update

apt-get install -y rabbitmq-server

systemctl enable rabbitmq-server

#CP env file
cp -rf /var/www/$server/.env.example /var/www/$server/.env

#configure xdebug
echo "xdebug.remote_enable=true" | tee -a /etc/php/7.0/mods-available/xdebug.ini
echo "xdebug.remote_connect_back=true" | tee -a /etc/php/7.0/mods-available/xdebug.ini
echo "xdebug.idekey=PHPSTORM" | tee -a /etc/php/7.0/mods-available/xdebug.ini

#restart services
service php7.0-fpm restart
service nginx restart

cd /var/www/$server

#Composer install
COMPOSER_PROCESS_TIMEOUT=2000 composer install

#Key generate
php artisan key:generate

chmod -R a+w storage/
mkdir -p bootstrap/cache/
chmod -R a+w bootstrap/cache/

timedatectl set-timezone Europe/Kiev
