<?php

return [
    'db' => [
        'adapters' => [
            'Application\Db\Content\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/content/content-production.sqlite3',
            ],
            'Application\Db\Credentials\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/credentials/credentials-production.sqlite3',
            ],
            'Application\Db\Event\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/event/event-production.sqlite3',
            ],
            'Application\Db\Petition\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/petition/petition-production.sqlite3',
            ],
            'Application\Db\Petition\Signature\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/petition-signature/petition-signature-production.sqlite3',
            ],
            'Application\Db\Article\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/article/article-production.sqlite3',
            ],
            'Application\Db\Rbac\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/rbac/rbac-production.sqlite3',
            ],
            'Application\Db\Shrt\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/shrt/shrt-production.sqlite3',
            ],
            'Application\Db\GeneratorXdd\LocalSQLiteAdapter' => [
                'driver' => 'Pdo_Sqlite',
                'dsn'    => 'sqlite:./data/database/generator-xdd.sqlite3',
            ],
        ],
    ],
];