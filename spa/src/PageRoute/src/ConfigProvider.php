<?php

declare(strict_types=1);

namespace PageRoute;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'app' => $this->getApplicationConfig(),
        ];
    }

    public function getDependencies()
    {
        return [];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'PageRoute\Router\TableService' => [
                    'gateway' => [
                        'name' => 'PageRoute\Router\TableGateway',
                    ],
                ],
                'PageRoute\RouterEntry\TableService' => [
                    'gateway' => [
                        'name' => 'PageRoute\RouterEntry\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageRoute\Router\TableGateway' => [
                    'name' => 'PageRoute\Router\TableGateway',
                    'table' => [
                        'name' => 'route',
                        'object' => \PageRoute\Model\RouteTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageRoute\Model\RouteModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'PageRoute\RouterEntry\TableGateway' => [
                    'name' => 'PageRoute\RouterEntry\TableGateway',
                    'table' => [
                        'name' => 'router',
                        'object' => \PageRoute\Model\RouterTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageRoute\Model\RouterEntryModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.router.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'PageRoute\RouterEntry\TableGateway',
                                    'db_select' => [
                                        'columns' => [
                                            'uid',
                                            'parent_uid',
                                            'application_uid',
                                            'site_uid',
                                            'route_uid',
                                            'route_url',
                                            'scenario',
                                            'controller',
                                            'method',
                                            'attributes',
                                            'status',
                                            'created',
                                            'comm'
                                        ],
                                        'join' => [
                                            [
                                                'on' => 'route',
                                                'where' => 'route.uid = router.route_uid',
                                                'columns' => ['route_name'],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.router.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Routers"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Router"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.router.create'
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
                                                    'uid'=>_("UID"),
                                                    'type'=>_("Parent"),
                                                    'application_uid'=>_("App"),
                                                    'site_uid'=>_("Site"),
                                                    'route_uid'=>_("Route UID"),
                                                    'route_name'=>_("Route Name"),
                                                    'route_url'=>_("Url"),
                                                    'scenario'=>_("Scenario"),
                                                    'controller'=>_("Controller"),
                                                    'method'=>_("Method"),
                                                    'attributes'=>_("Attributes"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'uid'],
                                                    ['column'=>'parent_uid'],
                                                    ['column'=>'application_uid'],
                                                    ['column'=>'site_uid'],
                                                    ['column'=>'route_uid'],
                                                    ['column'=>'route_name'],
                                                    ['column'=>'route_url'],
                                                    ['column'=>'scenario'],
                                                    ['column'=>'controller'],
                                                    ['column'=>'method'],
                                                    ['column'=>'attributes'],
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
                                                                        'admin.router.read',
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
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => _("Update"),
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-default btn-outline-primary ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.router.update',
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
                                    ], // main
                                ],
                            ],
                        ],
                    ],
                ],
            ], // handler
        ];
    }

}
