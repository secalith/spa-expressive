
# Single Page Application - VIRTUAL HOST with VAGRANT #

The idea of application is to create Single Page Application with editable content.

ip: 192.168.56.181

h:  http://spa-content.puphpet/


Installation
------

#### Virtual Machine
Uses Puphphet downloaded from https://puphpet.com . Configured to use with Apache and SQLite.

By default SPA-1601 uses 1cpu and 256MB 

If you have `vagrant` installed run `vagrant up` in your repo's root directory and wait.

When it is up run `vagrant ssh` and `cd /var/www/spa-1601/` , we will operate from there.


Developer may use custom Puphpet configuration by placing own file at `./puphpet/config-custom.yaml` . This file is set to ignore in .gitignore
