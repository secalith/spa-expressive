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
            ],
            'delegators' => [
                \Page\Handler\PageHandler::class => [
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
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'spa.page.list' => [
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
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'spa.user.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Pages',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create Page',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.page.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'table' => [
                                        'main' => [
                                            'name' => 'main',
                                            'headers'=> [
                                                'name'=>'Page Name',
                                                'route_url'=>'Route Url',
                                                'status'=>'Status',
                                                'created'=>'Created',
                                                100=>'Details',
                                            ],
                                            'rows' => [
                                                ['column'=>'name'],
                                                ['column'=>'route_url'],
                                                ['column'=>'status'],
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
                                                                    'spa.user.read',
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
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // spa.page.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }

}
