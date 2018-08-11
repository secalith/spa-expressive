#!/bin/bash

rm ./data/database/content/content-production.sqlite3
touch ./data/database/content/content-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_content.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_content.yml -e production

rm ./data/database/credentials/credentials-production.sqlite3
touch ./data/database/credentials/credentials-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_credentials.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_credentials.yml -e production

rm ./data/database/rbac/rbac-production.sqlite3
touch ./data/database/rbac/rbac-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_rbac.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_rbac.yml -e production

rm ./data/database/event/event-production.sqlite3
touch ./data/database/event/event-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_event.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_event.yml -e production

rm ./data/database/article/article-production.sqlite3
touch ./data/database/article/article-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_article.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_article.yml -e production

rm ./data/database/petition/petition-production.sqlite3
touch ./data/database/petition/petition-production.sqlite3
php ./vendor/bin/phinx migrate -c phinx_petition.yml -e production
php ./vendor/bin/phinx seed:run -c phinx_petition.yml -e production