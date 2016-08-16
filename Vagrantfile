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
  config.vm.network "forwarded_port", guest: 80, host: 9080

  # Neo4j
  config.vm.network "forwarded_port", guest: 7474, host: 7474
  config.vm.network "forwarded_port", guest: 7687, host: 7687

  # Enable provisioning with a shell script
  config.vm.provision "file", source: "apache.conf", destination: "/tmp/separation.conf"
  config.vm.provision "shell", path: "provisioner.sh"

end
