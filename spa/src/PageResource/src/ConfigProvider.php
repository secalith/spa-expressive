<?php

declare(strict_types=1);

namespace PageResource;

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
                'PageResource\TableService' => [
                    'gateway' => [
                        'name' => 'PageResource\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageResource\TableGateway' => [
                    'name' => 'PageResource\TableGateway',
                    'table' => [
                        'name' => 'page_resource',
                        'object' => Model\PageResourceTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => Model\PageResourceModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.page-resource.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'PageResource\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','page_uid','resource_uid','resource_name','resource_type','resource_cache','parameters','status','created',],
                                        'join' => [
                                            [
                                                'on' => 'site',
                                                'where' => 'site.uid = page_resource.site_uid',
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
                                    'route_name' => 'admin.page-resource.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Page Resource"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Page Resource"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.page-resource.create'
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
                                                    'page_uid'=>_("page_uid"),
                                                    'site_uid'=>_("Site UID"),
                                                    'resource_uid'=>_("Resource UID"),
                                                    'resource_name'=>_("Resource Name"),
                                                    'resource_type'=>_("Resource Type"),
                                                    'resource_cache'=>_("Resource Cache"),
                                                    'parameters'=>_("Parameters"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Details'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'page_uid'],
                                                    ['column'=>'site_uid'],
                                                    ['column'=>'resource_uid'],
                                                    ['column'=>'resource_name'],
                                                    ['column'=>'resource_type'],
                                                    ['column'=>'resource_cache'],
                                                    ['column'=>'parameters'],
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
                                                                        'admin.page-resource.read',
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
