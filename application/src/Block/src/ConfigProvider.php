<?php

declare(strict_types=1);

namespace Block;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'view_helpers' => [
                'invokables'=> [
//                    'displayBlock' => \Block\View\Helper\BlockHelper::class,
                ],
            ],
            'application' => [
                'module' => [
                    'route' => [
                        'block' => [
                            'database' => [
                                'db' => [
                                    'table' => 'block',
                                ],
                            ],
                            'gateway' => [
                                "adapter" => "Application\Db\LocalAdapter",
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                'service' => [
                                    "name" => "Block\\Gateway",
                                ],
                                'hydrator' => [
                                    "class" => \Common\Hydrator\CommonTableEntityHydrator::class,
                                    "map" => [
                                        "uid" => "uid",
                                        "area" => "area",
                                        "type" => "type",
                                        "template" => "template",
                                        "content" => "content",
                                        "attributes" => "attributes",
                                        "parameters" => "parameters",
                                        "options" => "options",
                                        "name" => "name",
                                        "order" => "order",
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

}
