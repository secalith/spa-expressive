<?php
return array(
    'db' => array(
        'database' => 'data/database/spa1601.sqlite',
        'driver' => 'PDO_Sqlite',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
