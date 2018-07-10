# -*- mode: ruby -*-
# vi: set ft=ruby :


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

	ServerName "spa.local.vm";
	ServerAlias "www.spa.local.vm";

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

echo "192.168.0.85  www.auth.local.vm auth.local.vm" >> /etc/hosts
echo "192.168.0.86  www.envoyer.local.vm envoyer.local.vm" >> /etc/hosts
echo "192.168.0.87  www.petitions.local.vm petitions.local.vm" >> /etc/hosts

cd /var/www/application
touch ./data/database/content-development.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8084 or http://spa.local.vm in your browser for to view the application **"
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

	ServerName "petitions.local.vm";
	ServerAlias "www.petitions.local.vm";

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

echo "192.168.0.84  www.spa.local.vm spa.local.vm" >> /etc/hosts
echo "192.168.0.85  www.auth.local.vm auth.local.vm" >> /etc/hosts
echo "192.168.0.86  www.envoyer.local.vm envoyer.local.vm" >> /etc/hosts

cd /var/www/application
touch ./data/database/content-development.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8087 or http://spa.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.87 **"
SCRIPT

@script_auth = <<SCRIPT

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

	ServerName "auth.local.vm";
	ServerAlias "www.auth.local.vm";

	<Directory \"/var/www/application/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/application/logs/error.log
	CustomLog /var/www/application/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/001-auth.conf

a2ensite 001-auth

service apache2 restart

##

echo "192.168.0.84  www.spa.local.vm spa.local.vm" >> /etc/hosts
echo "192.168.0.86  www.envoyer.local.vm envoyer.local.vm" >> /etc/hosts
echo "192.168.0.87  www.petitions.local.vm petitions.local.vm" >> /etc/hosts

cd /var/www/application
touch ./data/database/credentials-credentials.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8084 or http://spa.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.84 **"

echo "** Visit http://localhost:8085 or http://auth.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.85 **"

SCRIPT

@script_envoyer = <<SCRIPT

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

	ServerName "envoyer.local.vm";
	ServerAlias "www.envoyer.local.vm";

	<Directory \"/var/www/application/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/application/logs/error.log
	CustomLog /var/www/application/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/002-envoyer.conf

a2ensite 002-envoyer

service apache2 restart

##

echo "192.168.0.84  www.spa.local.vm spa.local.vm" >> /etc/hosts
echo "192.168.0.85  www.auth.local.vm auth.local.vm" >> /etc/hosts
echo "192.168.0.87  www.petitions.local.vm petitions.local.vm" >> /etc/hosts

cd /var/www/application
touch ./data/database/messages-development.sqlite3
#php ./vendor/bin/phinx migrate
#php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

cd ~

##

echo "** Visit http://localhost:8084 or http://spa.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.84 **"

echo "** Visit http://localhost:8085 or http://auth.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.85 **"

echo "** Visit http://localhost:8086 or http://envoyer.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.86 **"
echo "** Visit http://localhost:8087 or http://petitions.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.87 **"
SCRIPT

Vagrant.configure("2") do |config|
    config.vm.box = "secalith/bionic64"
    config.vm.box_check_update = true

    config.vm.synced_folder '.', '/vagrant', id:"vagrant-root"

    config.vm.define "spa" do |spa|
        spa.vm.network "forwarded_port", guest: 84, host: 8084
        spa.vm.network :public_network, ip: "192.168.0.84"
        spa.vm.synced_folder './spa', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
        spa.vm.provision 'shell', inline: @script_spa
        spa.vm.hostname = 'spa.local.vm'
        spa.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 1024]
          v.customize ["modifyvm", :id, "--name", "SPA :: SPA"]
        end
    end

    config.vm.define "auth" do |auth|
        auth.vm.network "forwarded_port", guest: 85, host: 8085
        auth.vm.network :public_network, ip: "192.168.0.85"
        auth.vm.synced_folder './auth', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
        auth.vm.provision 'shell', inline: @script_auth
        auth.vm.hostname = 'auth.local.vm'
        auth.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 512]
          v.customize ["modifyvm", :id, "--name", "SPA :: Auth"]
        end
    end

    #config.vm.define "envoyer" do |envoyer|
    #    envoyer.vm.network "forwarded_port", guest: 86, host: 8086
    #    envoyer.vm.network :public_network, ip: "192.168.0.86"
    #    envoyer.vm.synced_folder './envoyer', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
    #    envoyer.vm.provision 'shell', inline: @script_auth
    #    envoyer.vm.hostname = 'envoyer.local.vm'
    #    envoyer.vm.provider :virtualbox do |v|
    #      v.customize ["modifyvm", :id, "--memory", 512]
    #      v.customize ["modifyvm", :id, "--name", "SPA :: Auth"]
    #    end
    #end



    config.vm.define "petitions" do |petitions|
        petitions.vm.network "forwarded_port", guest: 87, host: 8087
        petitions.vm.network :public_network, ip: "192.168.0.87"
        petitions.vm.synced_folder './spa', '/var/www/application', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
        petitions.vm.provision 'shell', inline: @script_petitions
        petitions.vm.hostname = 'petitions.local.vm'
        petitions.vm.provider :virtualbox do |v|
          v.customize ["modifyvm", :id, "--memory", 512]
          v.customize ["modifyvm", :id, "--name", "SPA :: petitions"]
        end
    end

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    end



end
