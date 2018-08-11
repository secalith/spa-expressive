<?php

declare(strict_types=1);

namespace Content;


class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
            'view_helpers' => [
                'invokables'=> [
                    'displayContent' => \Content\View\Helper\ContentHelper::class,
                ],
            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'content' => [__DIR__ . '/../templates/content'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Content\Service\ContentService::class => \Content\Service\Factory\ContentServiceFactory::class,
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Content\TableService' => [
                    'gateway' => [
                        'name' => 'Content\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Content\TableGateway' => [
                    'name' => 'Content\TableGateway',
                    'table' => [
                        'name' => 'content',
                        'object' => \Content\Model\ContentTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Content\Model\ContentModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }

}
