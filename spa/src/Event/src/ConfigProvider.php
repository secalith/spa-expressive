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
                'event-admin' => [__DIR__ . '/../templates/event-admin'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Event\Form\EventWriteForm::class => \Event\Form\Factory\FactoryEventWriteServiceFormFactory::class,
                \Event\Form\EventUpdateForm::class => \Event\Form\Factory\FactoryEventUpdateServiceFormFactory::class,
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
                        'name' => 'Application\Db\Event\LocalSQLiteAdapter',
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
                        'name' => 'Application\Db\Event\LocalSQLiteAdapter',
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
                        'name' => 'Application\Db\Event\LocalSQLiteAdapter',
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
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Event Group"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event-group.create'
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
                                            'route' => 'manager.event.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Event\Form\EventWriteForm::class,
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
                                            'text' => _("Create Event"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Events List'),
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
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'event-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.event.create.post',
                                        ],
                                        'form_factory' => \Event\Form\EventWriteForm::class,
//                                        'object' => \Event\Form\EventWriteForm::class,
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
                                                        [
                                                            'field_name' => 'status',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_event',
                                                                'source_field_name' => 'status',
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
                                                            'object' => \Event\Model\MemeItemModel::class,
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
                                                    'text' => _("Groups List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.event-group.list'
                                                    ],
                                                ],
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
                                        'form_create' => 'event-admin::template-event_group-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.event-group.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Event\Form\EventGroupWriteForm::class,
                                        'template' => 'event-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.event-group.create
                        'manager.event-group.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.event.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create"),
                                            'wrapper_class' => 'w-100',
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
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'event-admin::template-event_group-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.event-group.create.post',
                                        ],
                                        'object' => \Event\Form\EventGroupWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_event_group' => [
                                                    'fieldset_name' => 'fieldset_event_group',
                                                    'service' => [
                                                        [
                                                            'name'=>'Event\Group\TableService',
                                                            'object' => \Event\Model\EventGroupModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_event_group
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.event-group.create.post
                    ],
                ], // Common\Handler\Create
                "Common\Handler\Read"=> [
                    'route' => [
                        'manager.event.read' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'details',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-read',
                                    'body_class' => 'app-action-read',
                                    'forms' => [
                                        'form_read' => 'event-admin::template-read-item',
                                    ],
                                ],
                                'page_resource' => [
                                    [
                                        'name' => 'main',
                                        'fieldset_event' => [
                                            'fieldset_name' => 'fieldset_event',
                                            'type' => 'fieldset',
                                            'partial' => 'event-admin::template-read-item',
                                            'service' => [
                                                [
                                                    'service_name'=>'Event\TableService',
                                                    'object' => \Event\Model\MemeItemModel::class,
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
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.event.read',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Event Details',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Update Event',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'manager.event.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_event.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create Event',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.event.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Events',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.event.list'
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
                                                    'route' => 'manager.event.read',
                                                ],
                                                'object' => \Event\Form\EventReadForm::class,
                                                'read' => [
                                                    'fieldset_event' => [
                                                        'fieldset_name' => 'fieldset_event',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'Event\TableService',
                                                                'object' => \Event\Model\MemeItemModel::class,
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
                                                    'fieldset_event_details' => [
                                                        'fieldset_name' => 'fieldset_event_details',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'Event\Details\TableService',
                                                                'object' => \Event\Model\EventDetailsModel::class,
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
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ], // Common\Handler\Read
                'Common\Handler\Update'=> [
                    'route' => [
                        'manager.event.update' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'event-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.event.create.post',
                                        ],
                                        'name' => 'form_update',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Event\Form\EventUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.event.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Event Update'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Events'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.event.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Create Event'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.event.create'
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
                                                    'route' => 'manager.event.update',
                                                ],
//                                                'object' => \Event\Form\EventUpdateForm::class,
                                                'form_factory' => \Event\Form\EventUpdateForm::class,
                                                'read' => [
                                                    'fieldset_event' => [
                                                        'fieldset_name' => 'fieldset_event',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\TableService',
                                                                    'object' => \Event\Model\MemeItemModel::class,
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
                                                    'fieldset_event_details' => [
                                                        'fieldset_name' => 'fieldset_event_details',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\Details\TableService',
                                                                    'object' => \Event\Model\EventDetailsModel::class,
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
                        ],
                        'manager.event.update.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'event-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'event-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.event.create.post',
                                        ],
                                        'name' => 'form_update',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Event\Form\EventUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.event.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Event Update'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Events'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.event.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Create Event'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.event.create'
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
                                                    'route' => 'manager.event.update',
                                                ],
//                                                'object' => \Event\Form\EventUpdateForm::class,
                                                'form_factory' => \Event\Form\EventUpdateForm::class,
                                                'read' => [
                                                    'fieldset_event' => [
                                                        'fieldset_name' => 'fieldset_event',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\TableService',
                                                                    'object' => \Event\Model\MemeItemModel::class,
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
                                                    'fieldset_event_details' => [
                                                        'fieldset_name' => 'fieldset_event_details',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\Details\TableService',
                                                                    'object' => \Event\Model\EventDetailsModel::class,
                                                                    'method' => 'getItemByParentUid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'event_uid',
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
                                                        'fieldset_event' => [
                                                            'fieldset_name' => 'fieldset_event',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\TableService',
                                                                    'object' => \Event\Model\MemeItemModel::class,
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
                                                        ], // fieldset_event
                                                        'fieldset_event_details' => [
                                                            'fieldset_name' => 'fieldset_event_details',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Event\Details\TableService',
                                                                    'object' => \Event\Model\EventDetailsModel::class,
                                                                    'method' => 'updateItem',
                                                                    'arg_name_target' => 'event_uid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'event_uid',
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_event_details
                                                    ],
                                                ], // update
                                            ],
                                        ],
                                    ],
                                ],
                            ], // post
                        ],
                    ],
                ], // Common\Handler\Update
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
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.event.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Group"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.event-group.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Groups"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
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
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'city_global'],
                                                    ['column'=>'date_start'],
                                                    ['column'=>'group_name'],
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
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Group"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.event-group.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Event"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.event.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("List Events"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
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
                                    'layout' => 'layout::manager',
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
