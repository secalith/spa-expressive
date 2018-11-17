<?php

declare(strict_types=1);

namespace AggregatorPirate;

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
                'aggregator-pirate' => [__DIR__ . '/../templates/aggregator-pirate'],
                'aggregator-pirate-admin' => [__DIR__ . '/../templates/aggregator-pirate-admin'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
//                \Event\Form\AggregatorPirateWriteForm::class => \AggregatorPirate\Form\Factory\FactoryAggregatorPirateWriteServiceFormFactory::class,
                \AggregatorPirate\Form\EntryItemUpdateForm::class => \AggregatorPirate\Form\Factory\FactoryAggregatorPirateUpdateServiceFormFactory::class,
            ],
            'delegators' => [

            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'AggregatorPirate\EntryItem\TableService' => [
                    'identifier' => 'AggregatorPirate\EntryItem\TableService',
                    'gateway' => [
                        'name' => 'AggregatorPirate\EntryItem\TableGateway',
                    ],
                ],
                'AggregatorPirate\YtEntryItem\TableService' => [
                    'identifier' => 'AggregatorPirate\YtEntryItem\TableService',
                    'gateway' => [
                        'name' => 'AggregatorPirate\YtEntryItem\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'AggregatorPirate\EntryItem\TableGateway' => [
                    'name' => 'AggregatorPirate\EntryItem\TableGateway',
                    'table' => [
                        'name' => 'entry_item',
                        'object' => \AggregatorPirate\Model\EntryItemTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\AggregatorPirate\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \AggregatorPirate\Model\EntryItemModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'AggregatorPirate\YtEntryItem\TableGateway' => [
                    'name' => 'AggregatorPirate\YtEntryItem\TableGateway',
                    'table' => [
                        'name' => 'yt_entry_item',
                        'object' => \AggregatorPirate\Model\YtEntryItemTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\AggregatorPirate\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \AggregatorPirate\Model\YtEntryItemModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'manager.aggregator-pirate.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.event.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Event"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Events List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'event-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.aggregator-pirate.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \AggregatorPirate\Form\ItemWriteForm::class,
                                        'form_factory' => \AggregatorPirate\Form\ItemWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // manager.aggregator-pirate.create
                        'manager.aggregator-pirate.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.aggregator-pirate.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Item"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Items List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.aggregator-pirate.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'aggregator-pirate-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.aggregator-pirate.create.post',
                                        ],
                                        'form_factory' => \AggregatorPirate\Form\ItemWriteForm::class,
//                                        'object' => \AggregatorPirate\Form\ItemWriteForm::class,
                                        'pre_validate' => [
                                            'data' => [
                                                'fieldset_yt_entry_item' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_yt_entry_item',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'parent_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_entry_item',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'status',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_entry_item',
                                                                'source_field_name' => 'status',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_event_details
                                            ],
                                        ], // pre_validate
                                        'save' => [
                                            'data' => [
                                                'fieldset_entry_item' => [
                                                    'fieldset_name' => 'fieldset_entry_item',
                                                    'service' => [
                                                        [
                                                            'name'=>'AggregatorPirate\EntryItem\TableService',
                                                            'object' => \AggregatorPirate\Model\EntryItemModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_event
                                                'fieldset_yt_entry_item' => [
                                                    'fieldset_name' => 'fieldset_yt_entry_item',
                                                    'service' => [
                                                        [
                                                            'name'=>'AggregatorPirate\YtEntryItem\TableService',
                                                            'object' => \AggregatorPirate\Model\YtEntryItemModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_event_details
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.aggregator-pirate.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\Update'=> [
                    'route' => [
                        'manager.aggregator-pirate.update' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'aggregator-pirate-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'aggregator-pirate-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.aggregator-pirate.update.post',
                                        ],
                                        'name' => 'form_update',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.aggregator-pirate.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Pirate Update'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Pirate Material'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.aggregator-pirate.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_entry_item',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'manager.aggregator-pirate.update',
                                                ],
                                                'object' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
//                                                'form_factory' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
                                                'read' => [
                                                    'fieldset_entry_item' => [
                                                        'fieldset_name' => 'fieldset_entry_item',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\EntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\EntryItemModel::class,
                                                                    'method' => 'getItemByUid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                        ],
                                                                    ],
                                                                ],

                                                            ],
                                                        ],
                                                    ],
                                                    'fieldset_yt_entry_item' => [
                                                        'fieldset_name' => 'fieldset_yt_entry_item',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\YtEntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\YtEntryItemModel::class,
                                                                    'method' => 'getItemByParentUid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                        ],
                                                                    ],
                                                                ],

                                                            ],
                                                        ],
                                                    ],
                                                ], // read
                                            ],
                                        ],
                                    ],
                                ],
                            ], // get
                        ], // manager.aggregator-pirate.update
                        'manager.aggregator-pirate.update.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'aggregator-pirate-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'aggregator-pirate-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.aggregator-pirate.update.post',
                                        ],
                                        'name' => 'form_update',
                                        'object' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
//                                        'form_factory' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.aggregator-pirate.update.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Pirate Material Update'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Pirate Materials'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.aggregator-pirate.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_event',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'manager.aggregator-pirate.update.post',
                                                ],
                                                'object' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
//                                                'form_factory' => \AggregatorPirate\Form\EntryItemUpdateForm::class,
                                                'pre_validate' => [
                                                    'data' => [
                                                        'fieldset_yt_entry_item' => [
                                                            'form_name' => 'form_create',
                                                            'fieldset_name' => 'fieldset_yt_entry_item',
                                                            'change_value' => [
                                                                [
                                                                    'field_name' => 'status',
                                                                    'source' => [
                                                                        'type' => 'post-request',
                                                                        'source_name' => 'fieldset_entry_item',
                                                                        'source_field_name' => 'status',
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_petition_translation
                                                    ],
                                                ], // pre_validate
                                                'read' => [
                                                    'fieldset_entry_item' => [
                                                        'fieldset_name' => 'fieldset_entry_item',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\EntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\EntryItemModel::class,
                                                                    'method' => 'getItemByUid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'uid',
                                                                        ],
                                                                    ],
                                                                ],

                                                            ],
                                                        ],
                                                    ],
                                                    'fieldset_yt_entry_item' => [
                                                        'fieldset_name' => 'fieldset_yt_entry_item',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\YtEntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\YtEntryItemModel::class,
                                                                    'method' => 'getItemByParentUid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'parent_uid',
                                                                        ],
                                                                    ],
                                                                ],

                                                            ],
                                                        ],
                                                    ],
                                                ], // read
                                                'update' => [
                                                    'form_name' => 'form_update',
                                                    'data' => [
                                                        'fieldset_entry_item' => [
                                                            'fieldset_name' => 'fieldset_entry_item',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\EntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\EntryItemModel::class,
                                                                    'method' => 'updateItem',
                                                                    'arg_name_target' => 'uid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'uid',
                                                                        ],
                                                                    ],
                                                                ],

                                                            ],
                                                        ], // fieldset_entry_item
                                                        'fieldset_yt_entry_item' => [
                                                            'fieldset_name' => 'fieldset_yt_entry_item',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'AggregatorPirate\YtEntryItem\TableService',
                                                                    'object' => \AggregatorPirate\Model\YtEntryItemModel::class,
                                                                    'method' => 'updateItem',
                                                                    'arg_name_target' => 'parent_uid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'parent_uid',
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_yt_entry_item
                                                    ],
                                                ], // update
                                            ],
                                        ],
                                    ],
                                ],
                            ], // post
                        ], // manager.aggregator-pirate.update.post
                    ],
                ], // Common\Handler\Update
                'Common\Handler\List'=> [
                    'route' => [
                        'manager.aggregator-pirate.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'AggregatorPirate\EntryItem\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','comm','status','created'],
                                        'join' => [
                                            [
                                                'on' => 'yt_entry_item',
                                                'where' => 'yt_entry_item.parent_uid = entry_item.uid',
                                                'columns' => ['yt_id','title'],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.aggregator-pirate.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Items"),
                                            'buttons' => [
//                                                [
//                                                    'html_tag' => 'a',
//                                                    'text' => _("Add Item"),
//                                                    'attributes' => [
//                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
//                                                        'href' => 'helper::url:manager.aggregator-pirate.create'
//                                                    ],
//                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'table' => [
                                            [
                                                'name' => 'main',
                                                'headers'=> [
                                                    'title'=>_("title"),
                                                    'yt_id'=>_("yt_id"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'title'],
                                                    ['column'=>'yt_id'],
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
                                                                        'manager.aggregator-pirate.update',
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
                        ], // manager.aggregator-pirate.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }

}
