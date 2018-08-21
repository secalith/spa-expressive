<?php

declare(strict_types=1);

namespace Content;


class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
            'view_helpers' => [
                'invokables'=> [
                    'displayContent' => \Content\View\Helper\ContentHelper::class,
                ],
            ],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'content' => [__DIR__ . '/../templates/content'],
                'content-admin' => [__DIR__ . '/../templates/content-admin'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \Content\Service\ContentService::class => \Content\Service\Factory\ContentServiceFactory::class,
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Content\TableService' => [
                    'gateway' => [
                        'name' => 'Content\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Content\TableGateway' => [
                    'name' => 'Content\TableGateway',
                    'table' => [
                        'name' => 'content',
                        'object' => \Content\Model\ContentTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Content\Model\ContentModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'manager.content.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.content.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Content"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Contents List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:manager.content.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'content-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'content-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.content.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Content\Form\ContentWriteForm::class,
                                        'object' => \Content\Form\ContentWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // manager.content.create
                        'manager.content.create.post' => [
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
                                                            'object' => \Event\Model\EventModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_event
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.content.create.post
                    ],
                ], // Common\Handler\Create
                "Common\Handler\Read"=> [
                    'route' => [
                        'manager.content.read' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'details',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'content-admin::template-read',
                                    'body_class' => 'app-action-read',
                                    'forms' => [
                                        'form_read' => 'content-admin::template-read-item',
                                    ],
                                ],
                                'page_resource' => [
                                    [
                                        'name' => 'main',
                                        'fieldset_content' => [
                                            'fieldset_name' => 'fieldset_content',
                                            'type' => 'fieldset',
                                            'partial' => 'content-admin::template-read-item',
                                            'service' => [
                                                [
                                                    'service_name'=>'Content\TableService',
                                                    'object' => \Content\Model\ContentModel::class,
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
                                    'route_name' => 'manager.content.read',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Content Details'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Update Content'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'manager.content.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_content.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Create Content'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.content.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Content'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.content.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_content',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'manager.content.read',
                                                ],
                                                'object' => \Content\Form\ContentReadForm::class,
                                                'read' => [
                                                    'fieldset_content' => [
                                                        'fieldset_name' => 'fieldset_content',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'Content\TableService',
                                                                'object' => \Content\Model\ContentModel::class,
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
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ], // Common\Handler\Read
                "Common\Handler\List"=> [
                    'route' => [
                        'manager.content.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Content\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','parent_uid','block_uid','template_uid','status','type','content','attributes','parameters','options','order','created'],
//                                        'join' => [
//                                            [
//                                                'on' => 'event_group',
//                                                'where' => 'event_group.uid = event.event_group',
//                                                'columns' => ['group_name'=>'name'],
//                                                'union' => 'left',
//                                            ],
//                                            [
//                                                'on' => 'event_details',
//                                                'where' => 'event_details.event_uid = event.uid',
//                                                'columns' => ['city','city_global','details_name'=>'name','date_start','date_finish','timezone'],
//                                                'union' => 'left',
//                                            ],
//                                        ],
                                    ],
                                ], // paginator
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'common-admin::template-list',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.content.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Content Items"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Content"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.content.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                    'main' => [
                                        'table' => [
                                            [
                                                'name' => 'main',
                                                'headers'=> [
                                                    'parent_uid'=>_("Parent"),
                                                    'block_uid'=>_("Block_uid"),
                                                    'template_uid'=>_("Template_uid"),
                                                    'type'=>_("type"),
                                                    'content'=>_("content"),
//                                                    'attributes'=>_("Attributes"),
//                                                    'parameters'=>_("Parameters"),
//                                                    'options'=>_("Options"),
                                                    'order'=>_('Order'),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'parent_uid'],
                                                    ['column'=>'block_uid'],
                                                    ['column'=>'template_uid'],
                                                    ['column'=>'type'],
                                                    ['column'=>'content'],
                                                    ['column'=>'status'],
                                                    ['column'=>'order'],
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
                                                                        'manager.content.read',
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
                                ], // data_template_model
                            ],
                        ],
                    ],
                ],
            ], // handler
        ];
    }

}
