<?php

declare(strict_types=1);

namespace Site;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
            'rbac' => [
                'permissions'	=>	[
                    'contributor'	=>	[
                        'admin.site.create',
                    ],
                    'editor'	=>	[
                        'admin.site.create',
                    ],
                    'administrator'	=>	[
                        'admin.site.create',
                    ],
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [],
            'factories'  => [
                \Site\Form\WriteForm::class => \Site\Form\Factory\FactoryWriteServiceFormFactory::class,
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
                'site' => [__DIR__ . '/../templates/site'],
                'site-admin' => [__DIR__ . '/../templates/site-admin'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Site\TableService' => [
                    'gateway' => [
                        'name' => 'Site\TableGateway',
                    ],
                ],
            ], // table_service
            'gateway' => [
                'Site\TableGateway' => [
                    'name' => 'Site\TableGateway',
                    'table' => [
                        'name' => 'site',
                        'object' => \Site\Model\SiteTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Site\Model\SiteModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.site.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Site\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','site_name','application_uid','status','created',],
                                        'join' => [
                                            [
                                                'on' => 'application',
                                                'where' => 'application.uid = site.application_uid',
                                                'columns' => ['type',],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.site.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Sites',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create Site',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.site.create'
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
                                                    'uid'=>'UID',
                                                    'site_name'=>'Name',
                                                    'status'=>'Status',
                                                    'type'=>'Type',
                                                    'created'=>'Created',
                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'uid'],
                                                    ['column'=>'site_name'],
                                                    ['column'=>'status'],
                                                    ['column'=>'type'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => 'Update',
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-default btn-outline-primary ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.site.update',
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
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
                                ],
                            ],
                        ], // spa.site.list
                    ], // route
                ], // Common\Handler\List
                'Common\Handler\Create' => [
                    'route' => [
                        'admin.site.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'admin.site.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Site"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Sites List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.site.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'site-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'site-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.site.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Application\Form\ApplicationWriteForm::class,
                                        'form_factory' => \Site\Form\WriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ],
                        'admin.site.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'admin.site.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Site"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Sites List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.site.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'site-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'site-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'admin.site.create.post',
                                        ],
                                        'form_factory' => \Site\Form\WriteForm::class,
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_site' => [
                                                    'fieldset_name' => 'fieldset_site',
                                                    'service' => [
                                                        [
                                                            'name'=>'Site\TableService',
                                                            'object' => \Site\Model\SiteModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_site
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.application.create.post
                    ],
                ], // Common\Handler\Create
            ], // handler
        ];
    }
}
