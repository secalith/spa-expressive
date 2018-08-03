<?php

declare(strict_types=1);

namespace Page;

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

    public function getTemplates()
    {
        return [
            'paths' => [
                'page' => [__DIR__ . '/../templates/page'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Page\Handler\PageHandler::class => \Page\Handler\PageHandlerFactory::class,
                \Page\Service\PageService::class => \Page\Service\Factory\PageServiceFactory::class,
                \Page\Form\PageWriteForm::class => \Page\Form\Factory\FactoryPageWriteServiceFormFactory::class,
            ],
            'delegators' => [
                \Page\Handler\PageHandler::class => [
                    \Common\Delegator\RouteResourceAwareDelegator::class,
                    \Common\Delegator\PageResourceAwareDelegator::class,
                    \PageView\Handler\Delegator\PageViewDelegatorFactory::class,
                ],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Page\TableService' => [
                    'gateway' => [
                        'name' => 'Page\TableGateway',
                    ],
                ],
                'Page\Create\TableService' => [
                    'gateway' => [
                        'name' => 'Page\Create\TableGateway',
                    ],
                ],
                'Page\Create\Area\TableService' => [
                    'gateway' => [
                        'name' => 'Page\Create\Area\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Page\TableGateway' => [
                    'name' => 'Page\TableGateway',
                    'table' => [
                        'name' => 'page',
                        'object' => \Page\Model\PageTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Page\Model\PageModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Page\Create\TableGateway' => [
                    'name' => 'Page\Create\TableGateway',
                    'table' => [
                        'name' => 'page',
                        'object' => \Page\Model\PageTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Page\Model\PageCreateModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Page\Create\Area\TableGateway' => [
                    'name' => 'Page\Create\Area\TableGateway',
                    'table' => [
                        'name' => 'page',
                        'object' => \Page\Model\PageTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Page\Model\PageCreateModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'admin.page.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'admin.page.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.page.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                    'main' => [

                                        #TODO


                                        'view' => [
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_create',
                                                'form_element_path' => 'form_create.fieldset_page.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                        ],


                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-create',
                                    'body_class' => 'action-create action-create-page',
                                    'forms' => [
                                        'form_create' => 'common-admin::template-create',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.page.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Page\Form\PageWriteForm::class,
                                        'form_factory' => \Page\Form\PageWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.page.create
                        'admin.page.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'admin.page.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Page',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.page.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'restable-admin-client::form-create',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'admin.page.create.post',
                                        ],
//                                        'object' => \Page\Form\PageWriteForm::class,
                                        'form_factory' => \Page\Form\PageWriteForm::class,
                                        'pre_validate' => [
                                            'data' => [
                                                'fieldset_page' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_page',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'template_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_template',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'route_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_route',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ]
                                                    ],
                                                ], // fieldset_page
                                                'fieldset_route' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_route',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'route_name',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'name',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_route
                                                'fieldset_router' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_router',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'application_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'application_uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'route_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_route',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'site_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'site_uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'route_url',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'route_url',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_router
                                                'fieldset_template' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_template',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'route_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_route',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_template
                                                'fieldset_area' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_area',
                                                    'type' => 'complex',
                                                    'selector' => 'form_create.fieldset_page.page_type',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'page_type_event.uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'page_type_petition.uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'page_type_links.uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_page',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                    ],
                                                ], // collection_area
                                            ],
                                        ],
                                        'save' => [
                                            'data' => [
                                                'fieldset_page' => [
                                                    'fieldset_name' => 'fieldset_page',
                                                    'service' => [
                                                        [
                                                            'name'=>'Page\TableService',
                                                            'object' => \Page\Model\PageModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_page
                                                'fieldset_route' => [
                                                    'fieldset_name' => 'fieldset_route',
                                                    'service' => [
                                                        [
                                                            'name'=>'PageRoute\Router\TableService',
                                                            'object' => \PageRoute\Model\RouteModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_route
                                                'fieldset_router' => [
                                                    'fieldset_name' => 'fieldset_router',
                                                    'service' => [
                                                        [
                                                            'name'=>'PageRoute\RouterEntry\TableService',
                                                            'object' => \PageRoute\Model\RouterEntryModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_router
                                                'fieldset_template' => [
                                                    'fieldset_name' => 'fieldset_template',
                                                    'service' => [
                                                        [
                                                            'name'=>'PageTemplate\TableService',
                                                            'object' => \PageTemplate\Model\PageTemplateModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_template
                                                'fieldset_area' => [
                                                    'fieldset_name' => 'fieldset_area',
                                                    'type' => 'complex',
                                                    'service' => [
                                                        [
                                                            'name'=>'Page\Create\Area\TableService',
                                                            'object' => \Area\Model\AreaModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // collection_area
                                            ], // data
                                        ], // save
                                    ],
                                ], // forms
                            ], // post
                        ], // admin.page.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.page.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Page\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','route_url','status','created',],
                                        'join' => [
                                            [
                                                'on' => 'site',
                                                'where' => 'site.uid = page.site_uid',
                                                'columns' => ['site_name','site_status'=>'status'],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.page.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Strony"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Utworz Strone"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.page.create'
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
                                                    'name'=>_("Nazwa"),
                                                    'site_name'=>_("Witryna"),
                                                    'route_url'=>_("Url"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'site_name'],
                                                    ['column'=>'route_url'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => _("Szczegoly"),
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-info ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.page.read',
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
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // admin.page.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }

}
