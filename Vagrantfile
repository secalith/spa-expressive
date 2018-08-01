# -*- mode: ruby -*-
# vi: set ft=ruby :

####
#   Contains two VMs. SPA and PETITIONS
####

VAGRANTFILE_API_VERSION = '2'

@script_spa = <<SCRIPT

export APP_ENV=development

sudo apt-get update

########################
#   Configure xDebug   #
########################

echo "[xdebug]" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.default_enable=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_autostart=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_connect_back=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_enable=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_handler=dbgp" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_port='9000'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_host='127.0.0.1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.idekey='PHPSTORM'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_mode='req'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_depth='-1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_children='-1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_data='-1'" >> /etc/php/7.2/mods-available/xdebug.ini

##

#########################
#   Configure Apache2   #
#########################

echo "<VirtualHost *:80>
	DocumentRoot \"/var/www/application/public\"
	AllowEncodedSlashes On

	ServerName "manager.local.vm";
	ServerAlias "www.manager.local.vm";

	<Directory \"/var/www/application/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/application/logs/error.log
	CustomLog /var/www/application/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

a2ensite 000-default

service apache2 restart

##

echo "192.168.0.87  www.peticio.local.vm peticio.local.vm" >> /etc/hosts

cd /var/www/application
touch ./data/database/content-development.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8084 or http://manager.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.84 **"
SCRIPT

@script_petitions = <<SCRIPT

export APP_ENV=development

sudo apt-get update

########################
#   Configure xDebug   #
########################

echo "[xdebug]" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.default_enable=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_autostart=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_connect_back=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_enable=1" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_handler=dbgp" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_port='9000'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_host='127.0.0.1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.idekey='PHPSTORM'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.remote_mode='req'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_depth='-1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_children='-1'" >> /etc/php/7.2/mods-available/xdebug.ini
echo "xdebug.var_display_max_data='-1'" >> /etc/php/7.2/mods-available/xdebug.ini

##

#########################
#   Configure Apache2   #
#########################

echo "<VirtualHost *:80>
	DocumentRoot \"/var/www/application/public\"
	AllowEncodedSlashes On

	ServerName "peticio.local.vm";
	ServerAlias "www.peticio.local.vm";

	<Directory \"/var/www/application/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/application/logs/error-peticio.log
	CustomLog /var/www/application/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

a2ensite 000-default

service apache2 restart

##

echo "192.168.0.84  www.manager.local.vm manager.local.vm" >> /etc/hosts

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8084 or http://manager.local.vm in your browser for to view the application **"
echo "** Visit http://localhost:8087 or http://peticio.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.87 **"
SCRIPT

Vagrant.configure("2") do |config|
    config.vm.box = "secalith/bionic64"
    config.vm.box_check_update = true

    config.vm.synced_folder '.', '/vagrant', id:"vagrant-root"

    config.vm.define "manager" do |manager|
        manager.vm.network "forwarded_port", guest: 84, host: 8084
        manager.vm.network :public_network, ip: "192.168.0.84"
        manager.vm.synced_folder './spa', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
        manager.vm.provision 'shell', inline: @script_spa
        manager.vm.hostname = 'manager.local.vm'
        manager.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 768]
          v.customize ["modifyvm", :id, "--name", "Manager :: Expressive"]
        end
    end

    config.vm.define "peticio" do |peticio|
        peticio.vm.network "forwarded_port", guest: 87, host: 8087
        peticio.vm.network :public_network, ip: "192.168.0.87"
        peticio.vm.synced_folder './spa', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
        peticio.vm.provision 'shell', inline: @script_petitions
        peticio.vm.hostname = 'peticio.local.vm'
        peticio.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 512]
          v.customize ["modifyvm", :id, "--name", "SPA :: Peticio"]
        end
    end

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    end



end
