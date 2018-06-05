<?php

namespace Content;

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
