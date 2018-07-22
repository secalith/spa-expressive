
# Single Page Application - Content
The idea of application is to create Single Page Application with editable content.

ip: 192.168.56.181

h:  http://spa-content.puphpet/

dbuser: dbuser

dbpwd:  123

@see Common\Application\Factory\PipelineAndRoutesDelegator

#### Roadmap
The following Roadmap being proposed:

* v0.1  Static HTML with Developer's paths.
* v0.2  Output HTML being generated with ZF2 and Application configuration being loaded from DB.
* v0.3  Read the `Update Form` being displayed after click on the 'edit button' per area/block/content
* v0.4  Save the updated Content to DB
* v0.5  Authentication
* v0.6  Cache
* v0.7  Behavioural Tests
* v0.8  Unit Tests
* v0.9  Documentation
* v1.0  Live (deployment)


Installation
------

### Development Server
Meant to be used with puphpet

#### Virtual Machine
Uses Puphphet downloaded from https://puphpet.com . Configured to use with Apache and SQLite.

By default SPA-1601 uses 1cpu and 256MB 

If you have `vagrant` installed run `vagrant up` in your repo's root directory and wait.

When it is up run `vagrant ssh` and `cd /var/www/spa-1601/` , we will operate from there.


Developer may use custom Puphpet configuration by placing own file at `./puphpet/config-custom.yaml` . This file is set to ignore in .gitignore

#### PHP Build-in Server
For development or testing purposes may use PHP's built-in server, if on your local repository's host you have you have PHP CLI installed.
To do so navigate to repository's root directory and run `sudo php -S 127.0.0.1:1601 ./webclient/public/index.php`



If you want to access webclient from your local browser use then the machine should be accessible at `192.168.56.161` and the host is set as [spa-1601.puphpet](http://spa-1601.puphpet) so you could `sudo sed -i '$ a\\n# Single Page Application 1601 for Puphpet\n192.168.56.161\tspa-1601.puphpet' /etc/hosts` in order to configure hostname and IP of VM to your local machine


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

###Testing
For simple benchmark run `ab -n500 -c100 spa-content.puphpet/`

### Post Deployment Tasks


### Tutorials ###

 * Create heading button on spa.user.list
 * Create heading button on spa.user.details (with uid)

