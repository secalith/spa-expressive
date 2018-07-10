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
            'view_helpers' => [
                'invokables'=> [
                    'displayArea' => \Area\View\Helper\AreaHelper::class,
                ],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                \Area\Service\AreaService::class => \Area\Service\Factory\AreaServiceFactory::class,
            ],
            'delegators' => [
                \Page\Handler\PageHandler::class => [
//                    \Common\Application\Factory\PipelineAndRoutesDelegator::class,
                ],
            ],
        ];
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
