# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.box_check_update = false

  config.vm.provider "virtualbox" do |v|
    v.memory = 2014
  end

  config.vm.synced_folder "./", "/var/www", id: "vagrant-root"

  # Apache
  config.vm.network "forwarded_port", guest: 80, host: 8082
  config.vm.network "forwarded_port", guest: 443, host: 8083

  # ElasticSearch
  config.vm.network "forwarded_port", guest: 9200, host: 9200

  # Redis
  config.vm.network "forwarded_port", guest: 6379, host: 6379

  # Enable provisioning with a shell script
  config.vm.provision "file", source: "apache.conf", destination: "/tmp/separation.conf"
  config.vm.provision "shell", path: "provisioner.sh"

end
