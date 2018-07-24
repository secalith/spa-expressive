<?php

declare(strict_types=1);

namespace PageRoute;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'app' => $this->getApplicationConfig(),
        ];
    }

    public function getDependencies()
    {
        return [];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'PageRoute\Router\TableService' => [
                    'gateway' => [
                        'name' => 'PageRoute\Router\TableGateway',
                    ],
                ],
                'PageRoute\RouterEntry\TableService' => [
                    'gateway' => [
                        'name' => 'PageRoute\RouterEntry\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageRoute\Router\TableGateway' => [
                    'name' => 'PageRoute\Router\TableGateway',
                    'table' => [
                        'name' => 'route',
                        'object' => \PageRoute\Model\RouteTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageRoute\Model\RouteModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'PageRoute\RouterEntry\TableGateway' => [
                    'name' => 'PageRoute\RouterEntry\TableGateway',
                    'table' => [
                        'name' => 'router',
                        'object' => \PageRoute\Model\RouterTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageRoute\Model\RouterEntryModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }

}
