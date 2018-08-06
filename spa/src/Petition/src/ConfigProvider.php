<?php

declare(strict_types=1);

namespace Petition;

/**
 * The configuration provider for the Petition module
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
                'petition'    => [__DIR__ . '/../templates/petition'],
                'petition-admin'    => [__DIR__ . '/../templates/petition-admin'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Petition\TableService' => [
                    'identifier' => 'Petition\TableService',
                    'gateway' => [
                        'name' => 'Petition\TableGateway',
                    ],
                ],
                'Petition\Translation\TableService' => [
                    'identifier' => 'Petition\Translation\TableService',
                    'gateway' => [
                        'name' => 'Petition\Translation\TableGateway',
                    ],
                ],
            ], // table_service
            'gateway' => [
                'Petition\TableGateway' => [
                    'name' => 'Petition\TableGateway',
                    'table' => [
                        'name' => 'petition',
                        'object' => \Petition\Model\PetitionTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Petition\Model\PetitionModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Petition\Translation\TableGateway' => [
                    'name' => 'Petition\Translation\TableGateway',
                    'table' => [
                        'name' => 'petition_translation',
                        'object' => \Petition\Model\PetitionTranslationTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Petition\Model\PetitionTranslationModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'manager.petition.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Petition"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Petitions List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'petition-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.petition.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Petition\Form\PetitionWriteForm::class,
//                                        'form_factory' => \Event\Form\EventWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // manager.petition.create
                        'manager.petition.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Petition"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Petitions List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'petition-admin::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.petition.create.post',
                                        ],
                                        'object' => \Petition\Form\PetitionWriteForm::class,
                                        'pre_validate' => [
                                            'data' => [
                                                'fieldset_petition_translation' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_petition_translation',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'petition_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'site_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition',
                                                                'source_field_name' => 'site_uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'application_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition',
                                                                'source_field_name' => 'application_uid',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_petition_translation
                                            ],
                                        ], // pre_validate
                                        'save' => [
                                            'data' => [
                                                'fieldset_petition' => [
                                                    'fieldset_name' => 'fieldset_petition',
                                                    'service' => [
                                                        [
                                                            'name'=>'Petition\TableService',
                                                            'object' => \Petition\Model\PetitionModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_petition
                                                'fieldset_petition_translation' => [
                                                    'fieldset_name' => 'fieldset_petition_translation',
                                                    'service' => [
                                                        [
                                                            'name'=>'Petition\Translation\TableService',
                                                            'object' => \Petition\Model\PetitionTranslationModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_petition_translation
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.petition.create.post
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
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.event-group.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Events List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
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
                        ], // admin.petition-group.create
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
                        'manager.petition.translation.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.translation.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Create Translation"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Petitions List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'petition-admin::template-petition_translation-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.petition.translation.create.post',
                                        ],
                                        'object' => \Petition\Form\PetitionTranslationWriteForm::class,
//                                        'form_factory' => \Petition\Form\PetitionTranslationWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // manager.petition.translation.create
                        'manager.petition.translation.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.translation.create.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Translate Petition"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _('Petitions List'),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-create',
                                    'forms' => [
                                        'form_create' => 'petition-admin::template-petition_translation-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.petition.translation.create.post',
                                        ],
                                        'object' => \Petition\Form\PetitionTranslationWriteForm::class,
                                        'pre_validate' => [
                                            'data' => [
                                                'fieldset_petition_translation' => [
                                                    'form_name' => 'form_create',
                                                    'fieldset_name' => 'fieldset_petition_translation',
                                                    'change_value' => [
                                                        [
                                                            'field_name' => 'petition_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition_attach',
                                                                'source_field_name' => 'uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'site_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition_attach',
                                                                'source_field_name' => 'site_uid',
                                                            ],
                                                        ],
                                                        [
                                                            'field_name' => 'application_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition_attach',
                                                                'source_field_name' => 'application_uid',
                                                            ],
                                                        ],
                                                    ],
                                                ], // fieldset_petition_translation
                                            ],
                                        ], // pre_validate
                                        'save' => [
                                            'data' => [
                                                'fieldset_petition_translation' => [
                                                    'fieldset_name' => 'fieldset_petition_translation',
                                                    'service' => [
                                                        [
                                                            'name'=>'Petition\Translation\TableService',
                                                            'object' => \Petition\Model\PetitionTranslationModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_petition_translation
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.petition.translation.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\List'=> [
                    'route' => [
                        'manager.petition.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'Petition\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','name','status','created','country'],
//                                        'join' => [
//                                            [
//                                                'on' => 'petition_group',
//                                                'where' => 'petition_group.uid = petition.group',
//                                                'columns' => ['group_name'=>'name'],
//                                                'union' => 'left',
//                                            ],
//                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Petitions"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Translation"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.translation.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Create Petition"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition.create'
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
                                                    'country'=>_("Country"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
//                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'country'],
                                                    ['column'=>'status'],
                                                    ['column'=>'created'],
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
                        ], // manager.petition.list
                    ], // route
                ], // Common\Handler\List
            ],
        ];
    }
}
