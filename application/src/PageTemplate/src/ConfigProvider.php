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
            'application' => [
                'module' => [
                    'route' => [
                        'template' => [
                            'database' => [
                                'db' => [
                                    'table' => 'template',
                                ],
                            ],
                            'gateway' => [
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                "adapter" => "Application\Db\LocalAdapter",
                                'service' => ["name"=>"PageTemplate\\Gateway",],
                                'hydrator' => [
                                    "class" => \Common\Hydrator\CommonTableEntityHydrator::class,
                                    "map" => [
                                        "routeName" => "route_name",
                                        "uid" => "uid",
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ], // application
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [],
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
}
