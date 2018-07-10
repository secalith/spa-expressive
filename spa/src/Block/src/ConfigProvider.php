<?php

declare(strict_types=1);

namespace Block;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'app' => $this->getApplicationConfig(),
            'view_helpers' => [
                'invokables'=> [
                    'displayBlock' => \Block\View\Helper\BlockHelper::class,
                    'displayBlockCarousel' => \Block\View\Helper\BlockHelper::class,
                ],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Block\Service\BlockService::class => \Block\Service\Factory\BlockServiceFactory::class,
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Block\TableService' => [
                    'gateway' => [
                        'name' => 'Block\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Block\TableGateway' => [
                    'name' => 'Block\TableGateway',
                    'table' => [
                        'name' => 'block',
                        'object' => \Block\Model\BlockTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Block\Model\BlockModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }

}
