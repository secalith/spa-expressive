<?php

declare(strict_types=1);

namespace Area;

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
                'Area\TableService' => [
                    'gateway' => [
                        'name' => 'Area\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Area\TableGateway' => [
                    'name' => 'Area\TableGateway',
                    'table' => [
                        'name' => 'area',
                        'object' => \Area\Model\AreaTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Area\Model\AreaModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }

}
