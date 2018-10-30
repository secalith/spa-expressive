<?php

declare(strict_types=1);

namespace GeneratorXdd;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
//            'view_helpers' => [
//                'factories' => [
//                    'displayEventsListBlock' => \Event\View\Helper\Factory\BlockListHelperFactory::class,
//                ],
//            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
//                'generator-xdd' => [__DIR__ . '/../templates/generator-xdd'],
                'generator-xdd-admin' => [__DIR__ . '/../templates/generator-xdd-admin'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
//                \Event\Form\EventWriteForm::class => \Event\Form\Factory\FactoryEventWriteServiceFormFactory::class,
//                \Event\Form\EventUpdateForm::class => \Event\Form\Factory\FactoryEventUpdateServiceFormFactory::class,
            ],
            'delegators' => [

            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'GeneratorXdd\TableService' => [
                    'identifier' => 'GeneratorXdd\TableService',
                    'gateway' => [
                        'name' => 'GeneratorXdd\TableGateway',
                    ],
                ],
                'GeneratorXdd\Image\TableService' => [
                    'identifier' => 'GeneratorXdd\Image\TableService',
                    'gateway' => [
                        'name' => 'GeneratorXdd\Image\TableGateway',
                    ],
                ],
                'GeneratorXdd\Text\TableService' => [
                    'identifier' => 'GeneratorXdd\Text\TableService',
                    'gateway' => [
                        'name' => 'GeneratorXdd\Text\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'GeneratorXdd\TableGateway' => [
                    'name' => 'GeneratorXdd\TableGateway',
                    'table' => [
                        'name' => 'meme_item',
                        'object' => \GeneratorXdd\Model\MemeItemTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\GeneratorXdd\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \GeneratorXdd\Model\MemeItemModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'GeneratorXdd\Image\TableGateway' => [
                    'name' => 'GeneratorXdd\Image\TableGateway',
                    'table' => [
                        'name' => 'meme_image',
                        'object' => \GeneratorXdd\Model\MemeImageTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\GeneratorXdd\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \GeneratorXdd\Model\MemeImageModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'GeneratorXdd\Text\TableGateway' => [
                    'name' => 'GeneratorXdd\Text\TableGateway',
                    'table' => [
                        'name' => 'meme_text',
                        'object' => \GeneratorXdd\Model\MemeTextTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\GeneratorXdd\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \GeneratorXdd\Model\MemeTextModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'manager.generator-xdd.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'GeneratorXdd\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','status','created'],
//                                        'join' => [
//                                            [
//                                                'on' => 'meme_text',
//                                                'where' => 'meme_text.item_uid = meme_item.uid',
//                                                'columns' => ['text'=>'text'],
//                                                'union' => 'left',
//                                            ],
//                                            [
//                                                'on' => 'meme_image',
//                                                'where' => 'meme_image.item_uid = meme_item.uid',
//                                                'columns' => ['image','image'],
//                                                'union' => 'left',
//                                            ],
//                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.generator-xdd.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Memes"),
                                        ],
                                    ],
                                    'main' => [
                                        'table' => [
                                            [
                                                'name' => 'main',
                                                'headers'=> [
                                                    'text'=>_("Text"),
//                                                    'image'=>_("Image"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'text'],
//                                                    ['column'=>'image'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
                                                    ['buttons' => [
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
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => _("Update"),
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-default btn-outline-primary ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'manager.event.update',
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
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
                                ],
                            ], // get
                        ], // manager.event.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }

}
