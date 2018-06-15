<?php

declare(strict_types=1);

namespace Page;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'page' => [__DIR__ . '/../templates/page'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Page\Handler\PageHandler::class => \Page\Handler\PageHandlerFactory::class,
                \Page\Service\PageService::class => \Page\Service\Factory\PageServiceFactory::class,
            ],
            'delegators' => [
                \Page\Handler\PageHandler::class => [
                    \PageView\Handler\Delegator\PageViewDelegatorFactory::class,
                ],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Page\TableService' => [
                    'gateway' => [
                        'name' => 'Page\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Page\TableGateway' => [
                    'name' => 'Page\TableGateway',
                    'table' => [
                        'name' => 'page',
                        'object' => \Page\Model\PageTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Page\Model\PageModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'page_view' => [
                'Page\Handler\PageHandler' => [

                ],
            ],
        ];
    }

}
