### Development Server
Meant to be used with Virtual Box and Vagrant.


#### PHP Build-in Server
For development or testing purposes may use PHP's built-in server, if on your local repository's host you have you have PHP CLI installed.
To do so navigate to repository's root directory and run `sudo php -S 127.0.0.1:1888 ./spa/public/index.php`



If you want to access SPA from your local browser use then the machine should be accessible at `192.168.56.161` and the host is set as [spa-1601.puphpet](http://spa-1601.puphpet) so you could `sudo sed -i '$ a\\n# Single Page Application 1601 for Puphpet\n192.168.56.161\tspa-1601.puphpet' /etc/hosts` in order to configure hostname and IP of VM to your local machine


### Library Dependency

#### Composer
Composer's config file is located at `./webclient/` so if you `cd ./webclient/ && sudo composer update && cd ./..` it will update packages dependencies into ./weblient/vendor .
To view Composer's dependencies view file `./webclient/composer.json`

#### LESS (IGNORE)
The main LESS file is located at `./build/application/less/main.less` . The file `./build/application/less/custom.less` should contain custom css

Composer has set `twtbs/bootstrap` dependency (with composer). To compile default bootstrap into css file run 
>lessc /var/www/spa-1601/build/application/less/main.less > /var/www/spa-1601/webclient/public/assets/css/bootstrap.new.css

or run same from the script with `sh /var/www/spa-1601/script/less_compile.sh`

#### Grunt Tasks
In order to install grunt you will need to do the following:

If you dont have npm installed yet
>sudo apt-get install npm

then install grunt globally
>sudo npm install -g grunt-cli

navigate to the project's home directory and run install node dependencies
> sudo npm install

Now from your project's runt grunt default tasks set
>grunt

if after the command you see the following error
> /usr/bin/env: node: No such file or directory 

means the `node` installation directory cannot be found under given location, you may want to run the following command to fix it with:
> ln -s /usr/bin/nodejs /usr/bin/node

There is very basic setup with less, uglify and cssmin. Gruntfile and package.json are located at `./webclient`.

*compile less

*minify js

*minify css

### Database Configuration
Single Page Application is meant to be used with SQLite.
Database is located at `./webclient/data/database/spa_content.sqlite` and is available from the ZF2's serviceManager as `database`

The Virtual Machine has the `Adminer` application installed and it is available from host as `http://192.168.56.161/adminer/`, select the `Sqlite 3` option and paste `/var/www/spa-1601/webclient/data/database/spa1601.sqlite` (it is vm's location)

### Cache Configuration
Cache for config depends on APPLICATION_ENV which may be `production` or `development`

ZF classmap
> cd ./module/Application/ && php ../../vendor/zendframework/zendframework/bin/classmap_generator.php

ZF templatemap
> cd ./module/Application/ && php ../../vendor/zendframework/zendframework/bin/templatemap_generator.php
