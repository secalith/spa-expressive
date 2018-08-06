<?php

declare(strict_types=1);

namespace Article;

/**
 * The configuration provider for the Article module
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
            'view_helpers' => [
                'factories' => [
//                    'displayArticlesListBlock' => \Article\View\Helper\Factory\BlockListHelperFactory::class,
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
            'invokables' => [
            ],
            'factories'  => [
                \Article\Form\ArticleWriteForm::class => \Article\Form\Factory\FactoryArticleWriteServiceFormFactory::class,
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
                'article'    => [__DIR__ . '/../templates/article'],
                'article-admin' => [__DIR__ . '/../templates/article-admin'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Article\TableService' => [
                    'identifier' => 'Article\TableService',
                    'gateway' => [
                        'name' => 'Article\TableGateway',
                    ],
                ],
                'Article\Group\TableService' => [
                    'identifier' => 'Article\Group\TableService',
                    'gateway' => [
                        'name' => 'Article\Group\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Article\TableGateway' => [
                    'name' => 'Article\TableGateway',
                    'table' => [
                        'name' => 'article',
                        'object' => \Article\Model\ArticleTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Article\Model\ArticleModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Article\Group\TableGateway' => [
                    'name' => 'Article\Group\TableGateway',
                    'table' => [
                        'name' => 'article_group',
                        'object' => \Article\Model\ArticleGroupTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Article\Model\ArticleGroupModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'manager.article.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.article.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Article"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Articles List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article.list'
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
                                                'form_element_path' => 'form_create.fieldset_article.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                        ],


                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'article-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.article.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Article\Form\ArticleWriteForm::class,
//                                        'form_factory' => \Article\Form\ArticleWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ],
                        'manager.article-group.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.article-group.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Crete Article Group"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Articles Groups List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article-group.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Articles List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'article-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'article-admin::template-article_group-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.article-group.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Article\Form\ArticleGroupWriteForm::class,
                                        'template' => 'article-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.event-group.create
                    ],
                ],
                'Common\Handler\List'=> [
                    'route' => [
                        'manager.article.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Article\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','status','created','country'],
                                        'join' => [
                                            [
                                                'on' => 'article_group',
                                                'where' => 'article_group.uid = article.article_group',
                                                'columns' => ['group_name'=>'name'],
                                                'union' => 'left',
                                            ],
//                                            [
//                                                'on' => 'event_details',
//                                                'where' => 'event_details.event_uid = event.uid',
//                                                'columns' => ['city','city_global','details_name'=>'name','date_start','date_finish','timezone'],
//                                                'union' => 'left',
//                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.article.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Articles"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Article"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Group"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article-group.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Groups"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article-group.list'
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
                                                    'name'=>_("Name"),
//                                                    'city_global'=>_("City"),
//                                                    'date_start'=>_("Start"),
                                                    'group_name'=>_("Group"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
//                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
//                                                    ['column'=>'city_global'],
//                                                    ['column'=>'date_start'],
                                                    ['column'=>'group_name'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
//                                                    ['buttons' => [
//                                                        [
//                                                            'html_tag' => 'a',
//                                                            'text' => _("Details"),
//                                                            'attributes' => [
//                                                                'class' => 'btn btn-sm btn-info ml-5',
//                                                                'href' => [
//                                                                    'type' => 'plugin',
//                                                                    'name' => 'url',
//                                                                    'arguments' => [
//                                                                        'manager.event.read',
//                                                                        [
//                                                                            'uid'=> [
//                                                                                'source' => 'row-item',
//                                                                                'property' => 'uid',
//                                                                            ],
//                                                                        ]
//                                                                    ],
//                                                                ],
//                                                            ],
//                                                        ],
//                                                    ],],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // manager.event.list
                        'manager.article-group.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Article\Group\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','status','created'],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.article.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Article Groups"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Group"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article-group.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Article"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Articles"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.article.list'
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
                                                    'name'=>_("Name"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
//                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
//                                                    ['buttons' => [
//                                                        [
//                                                            'html_tag' => 'a',
//                                                            'text' => _("Details"),
//                                                            'attributes' => [
//                                                                'class' => 'btn btn-sm btn-info ml-5',
//                                                                'href' => [
//                                                                    'type' => 'plugin',
//                                                                    'name' => 'url',
//                                                                    'arguments' => [
//                                                                        'manager.event-group.read',
//                                                                        [
//                                                                            'uid'=> [
//                                                                                'source' => 'row-item',
//                                                                                'property' => 'uid',
//                                                                            ],
//                                                                        ]
//                                                                    ],
//                                                                ],
//                                                            ],
//                                                        ],
//                                                    ],],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // manager.event-group.list
                    ], // route
                ], // Common\Handler\List
            ],
        ];
    }

}
