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
            'factories'  => [],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'user'    => [__DIR__ . '/../templates/'],
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
                                                        'class' => 'btn btn-sm btn-info ml-5',
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
                                                    'site_name'=>'Name',
                                                    'status'=>'Status',
                                                    'type'=>'Type',
                                                    'created'=>'Created',
                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'site_name'],
                                                    ['column'=>'status'],
                                                    ['column'=>'type'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => 'Details',
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-info ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'admin.site.read',
                                                                        ['uid'=>"data::item=>uid"]
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
                                    'body_class' => 'app-action-list',
                                ],
                            ],
                        ], // spa.site.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }
}
