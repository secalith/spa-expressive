# -*- mode: ruby -*-
# vi: set ft=ruby :

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

	ServerName "local.vm";
	ServerAlias "www.local.vm";

	<Directory \"/var/www/public\">
		Options +Indexes +FollowSymLinks
		DirectoryIndex index.php
		Order allow,deny
		Allow from all
		AllowOverride All
	</Directory>

	ErrorLog /var/www/logs/error-spa.log
	CustomLog /var/www/logs/access.log combined

</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

a2enmod rewrite

service apache2 restart

##

#############
#   Other   #
#############

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/vagrant/.profile; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi

cd ~

##

echo "** Visit http://localhost:8008 or http://cv.local.vm in your browser for to view the application **"
SCRIPT

Vagrant.configure("2") do |config|
    config.vm.box = "secalith/bionic64"
    config.vm.box_check_update = true
    config.vm.network "forwarded_port", guest: 80, host: 8008
    config.vm.network :public_network, ip: "192.168.0.204"
    config.vm.synced_folder '.', '/var/www', id:"application-root",owner:"vagrant",group:"www-data",mount_options:["dmode=775,fmode=664"]
    config.vm.provision 'shell', inline: @script
    config.vm.hostname = 'local.vm'

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["modifyvm", :id, "--memory", "1024"]
        vb.customize ["modifyvm", :id, "--name", "SPA by Secalith"]
    end

end
