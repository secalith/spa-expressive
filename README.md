
# Single Page Application - Maketing Campaign with Newsletter

The idea of application is to create Single Page Application with editable content for the marketing purposes.

The application data is to be kept on local database, sqlite3 by default.

Built on the top of zend-expressive-skeleton project.


@see Common\Application\Factory\PipelineAndRoutesDelegator


Overview
------
The marketing application, allows to create single pages 

Features:
 * Create and edit and pages
 * Blocks of different type
 * Page resource
    * form
    * content
    * custom block
* SEO
* Email Database
* Email Template editor
* Scheduled Email Sender
* Email SPF authentication (many accounts)


Installation
------
The Application is supplied with Vagrant file. There are all details needed to deploy to machine with Ubuntu OS installed.



### Post Deployment Tasks


##### Database

Create, migrate and seed the `content` database for `production` environment:
~~~~
rm ./data/database/content/content-production.sqlite3
touch ./data/database/content/content-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_content.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_content.yml -e production
~~~~

Create and migrate the `credentials` database for the `production` environment:
~~~~
rm ./data/database/credentials/credentials-production.sqlite3
touch ./data/database/credentials/credentials-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_credentials.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_credentials.yml -e production
~~~~

### Tutorials ###

 * Create heading button on manager.my_module.list
 * Create heading button on manager.my_module.details (with uid)
 * Create Module

