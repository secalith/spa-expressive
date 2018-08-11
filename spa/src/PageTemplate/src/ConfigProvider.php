<?php

declare(strict_types=1);

namespace PageTemplate;

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

    public function getDependencies()
    {
        return [
            'factories'  => [
                \PageTemplate\Service\TemplateService::class => \PageTemplate\Service\Factory\TemplateServiceFactory::class,
            ],
            'delegator'  => [
                \Page\Handler\PageHandler::class => [
                    \PageTemplate\Handler\Delegator\PageTemplateDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'page-template'    => [__DIR__ . '/../templates/page-template'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'PageTemplate\TableService' => [
                    'gateway' => [
                        'name' => 'PageTemplate\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageTemplate\TableGateway' => [
                    'name' => 'PageTemplate\TableGateway',
                    'table' => [
                        'name' => 'template',
                        'object' => \PageTemplate\Model\PageTemplateTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageTemplate\Model\PageTemplateModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }
}
