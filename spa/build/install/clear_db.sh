#!/bin/bash

rm ./data/database/credentials-production.sqlite3
touch ./data/database/credentials-production.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run