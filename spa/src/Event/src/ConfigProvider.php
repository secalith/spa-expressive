<?php

declare(strict_types=1);

namespace Event;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
            'view_helpers' => [
                'factories' => [
                    'displayEventsListBlock' => \Event\View\Helper\Factory\BlockListHelperFactory::class,
                ],
            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'event' => [__DIR__ . '/../templates/event'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Event\Form\EventWriteForm::class => \Event\Form\Factory\FactoryEventWriteServiceFormFactory::class,
            ],
            'delegators' => [

            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Event\TableService' => [
                    'identifier' => 'Event\TableService',
                    'gateway' => [
                        'name' => 'Event\TableGateway',
                    ],
                ],
                'Event\Group\TableService' => [
                    'identifier' => 'Event\Group\TableService',
                    'gateway' => [
                        'name' => 'Event\Group\TableGateway',
                    ],
                ],
                'Event\Details\TableService' => [
                    'identifier' => 'Event\Details\TableService',
                    'gateway' => [
                        'name' => 'Event\Details\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Event\TableGateway' => [
                    'name' => 'Event\TableGateway',
                    'table' => [
                        'name' => 'event',
                        'object' => \Event\Model\EventTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Event\Model\EventModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Event\Group\TableGateway' => [
                    'name' => 'Event\Group\TableGateway',
                    'table' => [
                        'name' => 'event_group',
                        'object' => \Event\Model\EventGroupTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Event\Model\EventGroupModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Event\Details\TableGateway' => [
                    'name' => 'Event\Details\TableGateway',
                    'table' => [
                        'name' => 'event_details',
                        'object' => \Event\Model\EventDetailsTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Event\Model\EventDetailsModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'manager.event.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.event.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Event"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.list'
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
                                                'form_element_path' => 'form_create.fieldset_event.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                        ],


                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'common-admin::template-create',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.event.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Event\Form\EventWriteForm::class,
//                                        'form_factory' => \Event\Form\EventWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // manager.event.create
                        'manager.event.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.event.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.list'
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
                                            'route' => 'manager.event.create.post',
                                        ],
//                                        'form_factory' => \Event\Form\EventWriteForm::class,
                                        'object' => \Event\Form\EventWriteForm::class,
                                        'pre_validate' => [
                                            'data' => [
                                                'fieldset_event_details' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_event_details',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'event_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_event',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'site_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_event',
                                                                'source_field_name' => 'site_uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'application_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_event',
                                                                'source_field_name' => 'application_uid',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_event_details
                                            ],
                                        ], // pre_validate
                                        'save' => [
                                            'data' => [
                                                'fieldset_event' => [
                                                    'fieldset_name' => 'fieldset_event',
                                                    'service' => [
                                                        [
                                                            'name'=>'Event\TableService',
                                                            'object' => \Event\Model\EventModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_event
                                                'fieldset_event_details' => [
                                                    'fieldset_name' => 'fieldset_event_details',
                                                    'service' => [
                                                        [
                                                            'name'=>'Event\Details\TableService',
                                                            'object' => \Event\Model\EventDetailsModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_event_details
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.event.create.post
                        'manager.event-group.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.event-group.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Event Group"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Groups"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.event-group.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Events"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.event.list'
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
                                                'form_element_path' => 'form_create.fieldset_event.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                        ],


                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-create',
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
                                        'object' => \Page\Form\PageWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.event.create
                    ],
                ], // Common\Handler\Create
                'Common\Handler\List'=> [
                    'route' => [
                        'manager.event.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Event\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','status','created','country'],
                                        'join' => [
                                            [
                                                'on' => 'event_group',
                                                'where' => 'event_group.uid = event.event_group',
                                                'columns' => ['group_name'=>'name'],
                                                'union' => 'left',
                                            ],
                                            [
                                                'on' => 'event_details',
                                                'where' => 'event_details.event_uid = event.uid',
                                                'columns' => ['city','city_global','details_name'=>'name','date_start','date_finish','timezone'],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.event.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Events"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Event"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.create'
                                                    ],
                                                ],
//                                                [
//                                                    'html_tag' => 'a',
//                                                    'text' => _("Create Group"),
//                                                    'attributes' => [
//                                                        'class' => 'btn btn-sm btn-info ml-5',
//                                                        'href' => 'helper::url:manager.event-group.create'
//                                                    ],
//                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Groups"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event-group.list'
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
                                                    'city_global'=>_("City"),
                                                    'date_start'=>_("Start"),
                                                    'group_name'=>_("Group"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
//                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'city_global'],
                                                    ['column'=>'date_start'],
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
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // manager.event.list
                        'manager.event-group.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Event\Group\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','status','created'],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.event.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Event Groups"),
                                            'buttons' => [
//                                                [
//                                                    'html_tag' => 'a',
//                                                    'text' => _("Create Group"),
//                                                    'attributes' => [
//                                                        'class' => 'btn btn-sm btn-info ml-5',
//                                                        'href' => 'helper::url:manager.event-group.create'
//                                                    ],
//                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Event"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Events"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event.list'
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
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                ],
                            ], // get
                        ], // manager.event-group.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }

}
