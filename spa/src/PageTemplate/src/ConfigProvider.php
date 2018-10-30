<?php

declare(strict_types=1);

namespace PageTemplate;

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

    public function getDependencies()
    {
        return [
            'factories'  => [
                \PageTemplate\Service\TemplateService::class => \PageTemplate\Service\Factory\TemplateServiceFactory::class,
            ],
            'delegator'  => [
                \Page\Handler\PageHandler::class => [
                    \PageTemplate\Handler\Delegator\PageTemplateDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'page-template'    => [__DIR__ . '/../templates/page-template'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'PageTemplate\TableService' => [
                    'gateway' => [
                        'name' => 'PageTemplate\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'PageTemplate\TableGateway' => [
                    'name' => 'PageTemplate\TableGateway',
                    'table' => [
                        'name' => 'template',
                        'object' => \PageTemplate\Model\PageTemplateTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \PageTemplate\Model\PageTemplateModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.page-template.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'PageTemplate\TableGateway',
                                    'db_select' => [
                                        'columns' => [
                                            'uid',
                                            'route_uid',
                                            'type',
                                            'location',
                                            'name',
                                            'label',
                                            'comm',
                                            'status',
                                            'created',
                                        ],
//                                        'join' => [
//                                            [
//                                                'on' => 'site',
//                                                'where' => 'site.uid = page.site_uid',
//                                                'columns' => ['site_name','site_status'=>'status'],
//                                                'union' => 'left',
//                                            ],
//                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.page-template.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Templates"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Template"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.page-template.create'
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
                                                    'route_uid'=>_("Route UID"),
                                                    'type'=>_("Type"),
                                                    'location'=>_("Location"),
                                                    'label'=>_("Label"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'route_uid'],
                                                    ['column'=>'type'],
                                                    ['column'=>'location'],
                                                    ['column'=>'label'],
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
                                                                        'admin.page-template.update',
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
                                ], // data_template_model
                            ],
                        ],
                    ],
                ],
            ], // handler
        ];
    }
}
