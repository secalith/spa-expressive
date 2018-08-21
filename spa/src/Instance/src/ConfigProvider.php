<?php

declare(strict_types=1);

namespace Instance;

/**
 * The configuration provider for the Instance module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'instance'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Instance\TableService' => [
                    'gateway' => [
                        'name' => 'Instance\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Instance\TableGateway' => [
                    'name' => 'Instance\TableGateway',
                    'table' => [
                        'name' => 'instances',
                        'object' => \Instance\Model\InstanceTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Instance\Model\InstanceModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.instance.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Instance\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','application_uid','site_uid','client_uid','hostname','status','created',],
                                        'join' => [
                                            [
                                                'on' => 'site',
                                                'where' => 'site.uid = instances.site_uid',
                                                'columns' => ['site_name'],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.page.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Instances"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Instance"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.instance.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'table' => [
                                            [
                                                'name' => 'main',
                                                'headers'=> [
                                                    'application_uid'=>_("Nazwa"),
                                                    'site_uid'=>_("Site UID"),
                                                    'site_name'=>_("Site Name"),
                                                    'client_uid'=>_("Client UID"),
                                                    'hostname'=>_("Hostname"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Details'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'application_uid'],
                                                    ['column'=>'site_uid'],
                                                    ['column'=>'site_name'],
                                                    ['column'=>'client_uid'],
                                                    ['column'=>'hostname'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => _("Details"),
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-info ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.instance.read',
                                                                        [
                                                                            'uid'=> [
                                                                                'source' => 'row-item',
                                                                                'property' => 'uid',
                                                                            ],
                                                                        ]
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ], // Common\Handler\List
            ], // handler
        ];
    }
}
