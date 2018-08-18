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
                \Petition\Form\PetitionTranslationWriteForm::class => \Petition\Form\Factory\FactoryPetitionTranslationWriteServiceFormFactory::class,
                \Petition\Form\PetitionUpdateForm::class => \Petition\Form\Factory\FactoryPetitionUpdateServiceFormFactory::class,
                '\Petition\Form\PetitionSignatureWriteForm::class' => \Petition\Form\Factory\SignPetitionFormFactory::class,
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
                'petition-view'    => [__DIR__ . '/../templates/petition-view'],
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
                'Petition\Signature\TableService' => [
                    'identifier' => 'Petition\Signature\TableService',
                    'gateway' => [
                        'name' => 'Petition\Signature\TableGateway',
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
                        'name' => 'Application\Db\Petition\LocalSQLiteAdapter',
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
                        'name' => 'Application\Db\Petition\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Petition\Model\PetitionTranslationModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Petition\Signature\TableGateway' => [
                    'name' => 'Petition\Signature\TableGateway',
                    'table' => [
                        'name' => 'petition_signature',
                        'object' => \Petition\Model\PetitionSignatureTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\Petition\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Petition\Model\PetitionSignatureModel::class,
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
//                                        'form_factory' => \Petition\Form\PetitionWriteForm::class,
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
                        'manager.petition-group.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition-group.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Petition Group"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Groups List"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5 float-right',
                                                        'href' => 'helper::url:manager.petition-group.list'
                                                    ],
                                                ],
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
                                        'form_create' => 'petition-admin::template-petition_group-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.petition-group.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Petition\Form\PetitionGroupWriteForm::class,
                                        'template' => 'petition-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // admin.petition-group.create
                        'manager.petition-group.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.create.post',
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
                                        'form_create' => 'petition-admin::template-petition_group-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.petition-group.create.post',
                                        ],
                                        'object' => \Petition\Form\PetitionGroupWriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_petition_group' => [
                                                    'fieldset_name' => 'fieldset_petition_group',
                                                    'service' => [
                                                        [
                                                            'name'=>'Petition\Group\TableService',
                                                            'object' => \Petition\Model\PetitionGroupModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ], // fieldset_petition_group
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // manager.petition-group.create.post
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
//                                        'object' => \Petition\Form\PetitionTranslationWriteForm::class,
                                        'form_factory' => \Petition\Form\PetitionTranslationWriteForm::class,
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
//                                        'object' => \Petition\Form\PetitionTranslationWriteForm::class,
                                        'form_factory' => \Petition\Form\PetitionTranslationWriteForm::class,
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
                                                            'field_name' => 'application_uid',
                                                            'source' => [
                                                                'type' => 'post-request',
                                                                'source_name' => 'fieldset_petition_attach',
                                                                'source_field_name' => 'application_uid',
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
                "Common\Handler\Read"=> [
                    'route' => [
                        'manager.petition.read' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'details',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-read',
                                    'body_class' => 'app-action-read',
                                    'forms' => [
                                        'form_read' => 'petition-admin::template-read-item',
                                    ],
                                ],
                                'page_resource' => [
                                    [
                                        'name' => 'main',
                                        'fieldset_petition' => [
                                            'fieldset_name' => 'fieldset_petition',
                                            'type' => 'fieldset',
                                            'partial' => 'petition-admin::template-read-item',
                                            'service' => [
                                                [
                                                    'service_name'=>'Petition\TableService',
                                                    'object' => \Petition\Model\PetitionModel::class,
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
                                    'route_name' => 'manager.petition.read',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Petition Details',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Update Petition',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'manager.petition.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_petition.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create Petition',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.petition.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Petitions',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'fieldset_petition',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'manager.petition.read',
                                                ],
                                                'object' => \Petition\Form\PetitionReadForm::class,
                                                'read' => [
                                                    'fieldset_petition' => [
                                                        'fieldset_name' => 'fieldset_petition',
                                                        'type' => 'fieldset',
                                                        'partial' => 'petition-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'Petition\TableService',
                                                                'object' => \Petition\Model\PetitionModel::class,
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
                                                    'fieldset_petition_translation' => [
                                                        'fieldset_name' => 'fieldset_petition_translation',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'Petition\Translation\TableService',
                                                                'object' => \Petition\Model\PetitionTranslationModel::class,
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
                                        ], // list
                                        'table' => [
                                            [
                                                'name' => 'petition_translations',
                                                'type' => 'table',
                                                'partial' => 'common-admin::template-read-table-item',
                                                'headers'=> [
                                                    'name'=>_("Name"),
                                                    'country'=>_("Country"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
                                                    100=>_('Action'),
                                                ],
                                                'service' => [
                                                    [
                                                        'service_name'=>'Petition\Translation\TableService',
                                                        'object' => \Petition\Model\PetitionTranslationModel::class,
                                                        'method' => 'getItemsByParentUid',
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
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'country'],
                                                    ['column'=>'status'],
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
                                                                        'manager.petition.read',
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
                                ],
                            ],
                        ],
                    ],
                ], // Common\Handler\Read
                'Common\Handler\Update'=> [
                    'route' => [
                        'manager.petition.update' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::manager',
                                    'template' => 'petition-admin::template-update',
                                    'forms' => [
                                        'form_update' => 'petition-admin::template-update-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.petition.update.post',
                                        ],
                                        'name' => 'form_update',
                                        'form_factory' => \Petition\Form\PetitionUpdateForm::class,
                                        'template' => 'petition-admin::template-update',
                                    ]
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.petition.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Petition Update',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Details',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'manager.petition.read',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_petition.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Petitions',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:manager.petition.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:manager.petition.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_petition',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'manager.petition.update',
                                                ],
                                                'object' => \Petition\Form\PetitionUpdateForm::class,
                                                'read' => [
                                                    'fieldset_petition' => [
                                                        'fieldset_name' => 'fieldset_petition',
                                                        'base_fieldset_name' => 'form_update',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-update-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Petition\TableService',
                                                                    'object' => \Petition\Model\PetitionModel::class,
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
                                                        'fieldset_petition' => [
                                                            'fieldset_name' => 'fieldset_petition',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Petition\TableService',
                                                                    'object' => \Petition\Model\PetitionModel::class,
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
                                                        'fieldset_petition_translation' => [
                                                            'fieldset_name' => 'fieldset_petition_translation',
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'Petition\Translation\TableService',
                                                                    'object' => \Petition\Model\PetitionTranslationModel::class,
                                                                    'method' => 'updateItem',
                                                                    'arg_name_target' => 'petition_uid',
                                                                    'arguments' => [
                                                                        [
                                                                            'type' => 'service',
                                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                                            'method' => 'getMatchedParam',
                                                                            'arg_name' => 'uid',
                                                                            'arg_name_target' => 'petition_uid',
                                                                        ],
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_event_details
                                                    ],
                                                ], // updates
                                            ],
                                        ],
                                        'table' => [
                                            [
                                                'name' => 'petition_translations',
                                                'type' => 'table',
                                                'partial' => 'common-admin::template-read-table-item',
                                                'headers'=> [
                                                    'name'=>_("Name"),
                                                    'country'=>_("Country"),
                                                    'status'=>'Status',
                                                    'created'=>'Created',
                                                    100=>_('Action'),
                                                ],
                                                'service' => [
                                                    [
                                                        'service_name'=>'Petition\Translation\TableService',
                                                        'object' => \Petition\Model\PetitionTranslationModel::class,
                                                        'method' => 'getItemsByParentUid',
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
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'country'],
                                                    ['column'=>'status'],
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
                                                                        'manager.petition.read',
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
                                ],
                            ],
                        ],
                    ],
                ], // Common\Handler\Update
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
                                                    100=>_('Action'),
                                                ],
                                                'rows' => [
                                                    ['column'=>'name'],
                                                    ['column'=>'country'],
                                                    ['column'=>'status'],
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
                                                                        'manager.petition.read',
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
