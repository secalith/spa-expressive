<?php

declare(strict_types=1);

namespace PageResource;

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
                'PageResource\TableService' => [
                    'gateway' => [
                        'name' => 'PageResource\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageResource\TableGateway' => [
                    'name' => 'PageResource\TableGateway',
                    'table' => [
                        'name' => 'page_resource',
                        'object' => Model\PageResourceTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => Model\PageResourceModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }

}
