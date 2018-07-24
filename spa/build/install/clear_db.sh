#!/bin/bash

rm ./data/database/content-development.sqlite3
touch ./data/database/content-development.sqlite3
php ./vendor/bin/phinx migrate
php ./vendor/bin/phinx seed:run