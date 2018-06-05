# -*- mode: ruby -*-
# vi: set ft=ruby :

require 'getoptlong'

opts = GetoptLong.new(
  [ '--custom-option', GetoptLong::OPTIONAL_ARGUMENT ]
)

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT

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
	DocumentRoot \"/var/www/public\"
	AllowEncodedSlashes On

	ServerName "cv.local.vm";
	ServerAlias "www.cv.local.vm";

	<Directory \"/var/www/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/logs/error.log
	CustomLog /var/www/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

service apache2 restart

##

cd /var/www
touch ./data/database/content-development.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run

#############
#   Other   #
#############

apt-get install -y composer

cd ~

##

echo "** Visit http://localhost:8084 or http://cv.local.vm in your browser for to view the application **"
echo "** IP: 192.168.0.84 **"
SCRIPT

Vagrant.configure("2") do |config|
    config.vm.box = "secalith/bionic64"
    config.vm.box_version = "1.0.2"
    config.vm.box_check_update = true
    config.vm.network "forwarded_port", guest: 80, host: 8084
    config.vm.network "forwarded_port", guest: 3306, host: 3361
    config.vm.network :public_network, ip: "192.168.0.84"
    config.vm.synced_folder '.', '/vagrant', id:"vagrant-root"
    config.vm.synced_folder './application', '/var/www', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
    config.vm.provision 'shell', inline: @script
    config.vm.hostname = 'cv.local.vm'

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--memory", "1024"]
        vb.customize ["modifyvm", :id, "--name", "SPA by Secalith :: CV"]
    end

end
