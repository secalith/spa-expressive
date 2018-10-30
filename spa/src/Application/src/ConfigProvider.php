<?php

declare(strict_types=1);

namespace Application;

/**
 * The configuration provider for the Application module
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
                \Application\Form\ApplicationWriteForm::class => \Application\Form\Factory\FactoryApplicationWriteServiceFormFactory::class,
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
                'application' => [__DIR__ . '/../templates/application'],
                'application-admin' => [__DIR__ . '/../templates/application-admin'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Application\TableService' => [
                    'identifier' => 'Application\TableService',
                    'gateway' => [
                        'name' => 'Application\TableGateway',
                    ],
                ],
            ], // table_service
            'gateway' => [
                'Application\TableGateway' => [
                    'name' => 'Application\TableGateway',
                    'table' => [
                        'name' => 'application',
                        'object' => \Application\Model\ApplicationTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Content\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Application\Model\ApplicationModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'admin.application.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Application\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','type','status','created','comment'],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.application.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Applications"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Application"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:admin.application.create'
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
                                                    'uid'=>_("UID"),
                                                    'type'=>_("Type"),
                                                    'comment'=>_("Comment"),
                                                    'status'=>_('Status'),
                                                    'created'=>_('Created'),
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'uid'],
                                                    ['column'=>'type'],
                                                    ['column'=>'comment'],
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
                                                                        'admin.application.update',
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
                        ],
                    ],
                ], // Common\Handler\List
                'Common\Handler\Create' => [
                    'route' => [
                        'admin.application.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'admin.application.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Application"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Applications List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.application.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'application-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'application-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.application.create.post',
                                        ],
                                        'name' => 'form_create',
//                                        'object' => \Application\Form\ApplicationWriteForm::class,
                                        'form_factory' => \Application\Form\ApplicationWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ],
                        'admin.application.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'admin.application.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Application"),
                                            'wrapper_class' => '',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Applications List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:admin.application.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'application-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'application-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'admin.application.create.post',
                                        ],
                                        'form_factory' => \Application\Form\ApplicationWriteForm::class,
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_application' => [
                                                    'fieldset_name' => 'fieldset_application',
                                                    'service' => [
                                                        [
                                                            'name'=>'Application\TableService',
                                                            'object' => \Application\Model\ApplicationModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_application
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.application.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\Update'=> [
                    'route' => [
                        'admin.application.update' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'application-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'application-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'admin.application.create.post',
                                        ],
                                        'name' => 'form_update',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Event\Form\EventUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.application.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Application Update'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Applications'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:admin.application.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Create Event'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:admin.application.create'
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
                                                    'route' => 'admin.application.update',
                                                ],
//                                                'object' => \Event\Form\EventUpdateForm::class,
                                                'form_factory' => \Application\Form\ApplicationUpdateForm::class,
                                                'read' => [
                                                    'fieldset_event' => [
                                                        'fieldset_name' => 'fieldset_application',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Application\TableService',
                                                                    'object' => \Application\Model\ApplicationModel::class,
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
                                                ], // read
                                            ],
                                        ],
                                    ],
                                ],
                            ], // get
                        ],
                        'admin.application.update.post' => [
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
                                            'route' => 'admin.application.create.post',
                                        ],
                                        'name' => 'form_update',
//                                        'object' => \Event\Form\EventWriteForm::class,
                                        'form_factory' => \Application\Form\ApplicationUpdateForm::class,
                                        'template' => 'common-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'admin.application.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Update Application'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('List Applications'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:admin.application.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Create Application'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:admin.application.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_application',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'admin.application.update',
                                                ],
//                                                'object' => \Event\Form\EventUpdateForm::class,
                                                'form_factory' => \Application\Form\ApplicationUpdateForm::class,
                                                'read' => [
                                                    'fieldset_event' => [
                                                        'fieldset_name' => 'fieldset_application',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Application\TableService',
                                                                    'object' => \Application\Model\ApplicationModel::class,
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
                                                ], // read
                                                'update' => [
                                                    'form_name' => 'form_update',
                                                    'data' => [
                                                        'fieldset_event' => [
                                                            'fieldset_name' => 'fieldset_application',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Application\TableService',
                                                                    'object' => \Application\Model\ApplicationModel::class,
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
            ], // handler
        ];
    }
}
