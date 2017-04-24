# bintime-test

Installation:

1. Vagrant

Requirements:
1 - Vagrant (https://www.vagrantup.com/downloads.html)
2 - VirtualBox (http://www.oracle.com/technetwork/server-storage/virtualbox/downloads/index.html
3 - NFS service for Windows (for Linux "sudo apt-get install nfs-kernel-server nfs-common")

Add to local "hosts" file (/etc/hosts) value "192.168.50.95 bintime-test
IP and host name you can change, but you have to do same changes in main Vagrantfile, install.sh and virtual host config

Run command "vagrant up" from root folder vagrant
Use command "vagrant ssh" to log into virtual shell
Use command "vagrant reload" to restart and "vagrant destroy" to delete virtual machine

2. Site vendors

Log into virtual machine by using "vagrant ssh" command.
Go to site root on /var/www/bintime-test and run "composer install".

Run database migrations:
php artisan migrate --seed

3. RabbitMQ and queue

Default configuration:
    RABBITMQ_HOST=127.0.0.1
    RABBITMQ_PORT=5672
    RABBITMQ_VHOST=/
    RABBITMQ_LOGIN=guest
    RABBITMQ_PASSWORD=guest
    RABBITMQ_QUEUE=bintime-test-queue

Check if .env file contains smtp server configuration. By default i set free account for developers testing.
Like that:
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=0a1de24b936ada
    MAIL_PASSWORD=c5dad98fd19896

And now we can run queue processing "php artisan queue:listen".
For example as background process using bash utility screen (need install)

4. Elastic

Run from site root command "php artisan vendor:publish"
Check if exists in .env file index and type variables.
    PLASTIC_INDEX=order
    PLASTIC_HOST=127.0.0.1:9200

Important: create search index
 curl -XPUT 'http://127.0.0.1:9200/order/' -d '{ "settings" : { "index" : { "number_of_shards" : 3, "number_of_replicas" : 1 } } }'

Run command "php artisan mapping:run"

5. Unit testing

Run command "php artisan dusk" for browser testing form

----

If needed to connect to MongoDB throw GUI utility, open file /etc/mongod.conf and modify bindIp to 0.0.0.0