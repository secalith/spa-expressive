<?php

declare(strict_types=1);

namespace Content;


class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'view_helpers' => [
                'invokables'=> [
                    'displayContent' => View\Helper\ContentHelper::class,
                ],
            ],
            'application' => [
                'module' => [
                    'route' => [
                        'content' => [
                            'database' => [
                                'db' => [
                                    'table' => 'content',
                                ],
                            ],
                            'gateway' => [
                                "adapter" => "Application\Db\LocalAdapter",
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                'service' => ["name"=>"Content\\Gateway"],
                                'hydrator' => [
                                    "class" => \Common\Hydrator\CommonTableEntityHydrator::class,
                                    "map" => [
                                        "uid" => "uid",
                                        "block" => "block",
                                        "order" => "order",
                                        "content" => "content",
                                        "attributes" => "attributes",
                                        "parameters" => "parameters",
                                        "template" => "template",
                                        "type" => "type",
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
            'factories'  => [
                "Content\\Table" => \Content\Service\Factory\ContentTableServiceFactory::class,
                "Content\\Gateway" => \Content\Service\Factory\ContentTableGatewayFactory::class,
                Action\ReadAction::class => Action\ReadFactory::class,
                Action\WriteAction::class => Action\WriteFactory::class,
            ],
        ];
    }

}
