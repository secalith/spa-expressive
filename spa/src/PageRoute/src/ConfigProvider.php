<?php

declare(strict_types=1);

namespace PageRoute;

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

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                \PageRoute\Form\RouteWriteForm::class => \PageRoute\Form\Factory\RouteWriteServiceFormFactory::class,
                \PageRoute\Form\RouterWriteForm::class => \PageRoute\Form\Factory\FactoryRouterWriteServiceFormFactory::class,
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
                'route' => [__DIR__ . '/../templates/route'],
                'route-admin' => [__DIR__ . '/../templates/route-admin'],
            ],
        ];
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
                        'admin.route.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'PageRoute\Router\TableGateway',
                                    'db_select' => [
                                        'columns' => [
                                            'uid',
                                            'route_name',
                                            'status',
                                            'created',
                                            'comment'
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.route.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Routes"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Route"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.route.create'
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
                                                    'route_name'=>_("Route Name"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'uid'],
                                                    ['column'=>'route_name'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => _("Update"),
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-default btn-outline-primary ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.route.update',
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
                'Common\Handler\Create' => [
                    'route' => [
                        'admin.route.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'admin.route.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Route"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Routes List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.route.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'route-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'route-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.route.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Application\Form\ApplicationWriteForm::class,
                                        'form_factory' => \PageRoute\Form\RouteWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ],
                        'admin.route.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'admin.route.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Route"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Routes List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.route.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'route-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'route-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'admin.route.create.post',
                                        ],
                                        'form_factory' => \PageRoute\Form\RouteWriteForm::class,
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_route' => [
                                                    'fieldset_name' => 'fieldset_route',
                                                    'service' => [
                                                        [
                                                            'name'=>'PageRoute\Route\TableService',
                                                            'object' => \PageRoute\Model\RouteModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_application
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // admin.route.create.post
                        'admin.router.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'admin.router.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Router"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Routers List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.router.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'route-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'route-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.router.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Application\Form\ApplicationWriteForm::class,
                                        'form_factory' => \PageRoute\Form\RouterWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.router.create
                        'admin.router.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'admin.router.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Router"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Routers List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.router.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'router-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'router-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'admin.router.create.post',
                                        ],
                                        'form_factory' => \PageRoute\Form\RouterWriteForm::class,
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_route' => [
                                                    'fieldset_name' => 'fieldset_router',
                                                    'service' => [
                                                        [
                                                            'name'=>'PageRoute\RouterEntry\TableService',
                                                            'object' => \PageRoute\Model\RouteModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_application
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // admin.router.create.post
                    ],
                ], // Common\Handler\Create
            ], // handler
        ];
    }

}
