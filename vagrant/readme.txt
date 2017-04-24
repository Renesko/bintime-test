Installation

Requirements:
1 - Vagrant (https://www.vagrantup.com/downloads.html)
2 - VirtualBox (http://www.oracle.com/technetwork/server-storage/virtualbox/downloads/index.html
3 - NFS service for Windows (for Linux "sudo apt-get install nfs-kernel-server nfs-common")

Add to local "hosts" file (/etc/hosts) value "192.168.50.95 bintime-test
IP and host name you can change, but you have to do same changes in main Vagrantfile, install.sh and virtual host config

Run command "vagrant up" from root folder vagrant