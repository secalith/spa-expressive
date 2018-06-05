<?php

namespace Area;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers' => [
                'invokables'=> [
                    'displayArea' => View\Helper\AreaHelper::class,
                ],
            ],
            'application' => [
                'module' => [
                    'route' => [
                        'area' => [
                            'database' => [
                                'db' => [
                                    'table' => 'area',
                                ],
                            ],
                            'gateway' => [
                                "adapter" => "Application\Db\LocalAdapter",
//                                "adapter" => "Application\Db\DatabaseAdapter",
                                'service' => ["name"=>"Area\\Gateway",],
                                'hydrator' => [
                                    "class" => \Common\Hydrator\CommonTableEntityHydrator::class,
                                    "map" => [
                                        "uid" => "uid",
                                        "template" => "uid",
                                        "machineName" => "machine_name",
                                        "attributes" => "attributes",
                                        "parameters" => "parameters",
                                        "options" => "options",
                                        "scope" => "scope",
                                    ],
                                ],
                            ],
                        ], // area
                    ],
                ],
            ], // application
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                "Area\\Table" => \Area\Service\Factory\AreaTableServiceFactory::class,
                "Area\\Gateway" => \Area\Service\Factory\AreaTableGatewayFactory::class,
            ],
        ];
    }

}
