<?php

declare(strict_types=1);

namespace PageRoute;

class ConfigProvider extends CommonConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'application' => [
                'module' => [
                    'route' => [
                        'route' => [
                            'database' => [
                                'db' => [
                                    'table' => 'route',
                                ],
                            ],
                            'gateway' => [
                                "adapter" => "Application\Db\LocalAdapter",
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                'service' => ["name"=>"Route\\Gateway",],
                                'hydrator' => [
                                    "class" => \Common\Hydrator\CommonTableEntityHydrator::class,
                                    "map" => [
                                        "routeName" => "route_name",
                                        "uid" => "uid",
                                    ],
                                ],
                            ],

                        ],
                        'route_routes' => [
                            'database' => [
                                'db' => [
                                    'table' => 'route_routes',
                                ],
                            ],
                            'gateway' => [
                                "adapter" => "Application\Db\LocalAdapter",
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                'service' => ["name"=>"Route\\Routes\\Gateway",],
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
        return [];
    }

}
