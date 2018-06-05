<?php

namespace Block;

use Common\ConfigProvider as CommonConfigProvider;
/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider extends CommonConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers' => [
                'invokables'=> [
                    'displayBlock' => View\Helper\BlockHelper::class,
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
            'factories'  => [
                "Block\\Table" => \Block\Service\Factory\BlockTableServiceFactory::class,
                "Block\\Gateway" => \Block\Service\Factory\BlockTableGatewayFactory::class,
            ],
        ];
    }

}
