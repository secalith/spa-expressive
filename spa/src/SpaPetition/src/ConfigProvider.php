<?php

declare(strict_types=1);

namespace SpaPetition;

class ConfigProvider
{
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
                'user'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'SpaPetition\TableService' => [
                    'gateway' => [
                        'name' => 'SpaPetition\TableGateway',
                    ],
                ],
                'SpaPetition\Data\TableService' => [
                    'gateway' => [
                        'name' => 'SpaPetition\Data\TableGateway',
                    ],
                ],
                'SpaPetition\Data\Text\TableService' => [
                    'gateway' => [
                        'name' => 'SpaPetition\Data\Text\TableGateway',
                    ],
                ],
                'SpaPetition\Signature\TableService' => [
                    'gateway' => [
                        'name' => 'SpaPetition\Signature\TableGateway',
                    ],
                ],
                'SpaPetition\Date\TableService' => [
                    'gateway' => [
                        'name' => 'SpaPetition\Date\TableGateway',
                    ],
                ],
            ], // table_service
            'gateway' => [
                'SpaPetition\TableGateway' => [
                    'name' => 'SpaPetition\TableGateway',
                    'table' => [
                        'name' => 'petition',
                        'object' => \SpaPetition\Model\PetitionTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \SpaPetition\Model\PetitionModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\Create' => [
                    'route' => [
                        'spa.spa-petition.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'spa.spa-petition.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Utworz Petycje"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => _("Lista Petycji"),
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.spa-petition.list'
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
                                        'form_create' => 'common-admin::template-create',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'spa.spa-petition.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => Form\WriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // spa.spa-petition.create
                        'spa.spa-petition.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'spa.spa-petition.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Utworz Petycje"),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Lista Petycji',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.spa-petition.list'
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
                                            'route' => 'spa.spa-petition.create.post',
                                        ],
                                        'object' => Form\WriteForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_petition' => [
                                                    'type' => 'fieldset',
                                                    'priority' => 110,
                                                    'fieldset_name' => 'fieldset_petition',
                                                    'service' => [
                                                        [
                                                            'name'=>'SpaPetition\TableService',
                                                            'object' => Model\PetitionBaseModel::class,
                                                            'method' => 'saveItem'
                                                        ],
                                                    ],
                                                ],
                                                /*
                                                'collection_petition' => [
                                                    'type' => 'collection',
                                                    'priority' => 100,
                                                    'collection_name' => 'collection_petition',
                                                    'service' => [
                                                        [
                                                            'name'=>'SpaPetition\TableService',
                                                            'object' => Model\UserModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                    'collection' => [
                                                        'fieldset_petition_data_title' => [
                                                            'type' => 'fieldset',
                                                            'priority' => 110,
                                                            'fieldset_name' => 'fieldset_petition_data_title',
                                                            'service' => [
                                                                [
                                                                    'name'=>'User\Profile\TableService',
                                                                    'object' => \User\Model\UserProfileModel::class,
                                                                    'method' => 'saveItem'
                                                                ],
                                                            ],
                                                            'entity_change' => [
                                                                [
                                                                    'field_name' => 'uid',
                                                                    'source' => [
                                                                        'type' => 'result-insert',
                                                                        'source_name' => 'fieldset_user',
                                                                        'source_field_name' => 'uid',
                                                                    ],
                                                                ],
                                                                [
                                                                    'field_name' => 'password',
                                                                    'source' => [
                                                                        'type' => 'result-transform',
                                                                        'source_name' => 'fieldset_credentials',
                                                                        'source_field_name' => 'password',
                                                                    ],
                                                                    'adapter' => [
                                                                        'object' => \Auth\Service\PasswordAdapter::class,
                                                                        'method' => 'create',
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_petition_data_title
                                                        'fieldset_petition_data_text' => [
                                                            'priority' => 110,
                                                            'type' => 'fieldset',
                                                            'fieldset_name' => 'fieldset_petition_data_text',
                                                            'service' => [
                                                                [
                                                                    'name'=>'User\Profile\TableService',
                                                                    'object' => \User\Model\UserProfileModel::class,
                                                                    'method' => 'saveItem'
                                                                ],
                                                            ],
                                                            'entity_change' => [
                                                                [
                                                                    'field_name' => 'uid',
                                                                    'source' => [
                                                                        'type' => 'result-insert',
                                                                        'source_name' => 'fieldset_user',
                                                                        'source_field_name' => 'uid',
                                                                    ],
                                                                ],
                                                                [
                                                                    'field_name' => 'password',
                                                                    'source' => [
                                                                        'type' => 'result-transform',
                                                                        'source_name' => 'fieldset_credentials',
                                                                        'source_field_name' => 'password',
                                                                    ],
                                                                    'adapter' => [
                                                                        'object' => \Auth\Service\PasswordAdapter::class,
                                                                        'method' => 'create',
                                                                    ],
                                                                ],
                                                            ],
                                                        ], // fieldset_petition_data_text
                                                    ], // collection
                                                ],
                                                */
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // restable.admin.client.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\List'=> [
                    'route' => [
                        'spa.spa-petition.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'SpaPetition\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','application_uid','site_uid','data_uid','status','created',],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'spa.spa-petition.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _('Petycje'),
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Utworz Petycje',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.spa-petition.create',
                                                            ],
                                                        ],
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
                                                    'uid'=>'UID',
                                                    'application_uid' => 'App UID',
                                                    'site_uid' => 'Strona',
                                                    'data_uid' => 'Data UID',
                                                    'status' => 1,
                                                    'created' => 'Created',
                                                    100=>'Details',
                                                ],
                                                'rows' => [
                                                    ['column' => 'uid'],
                                                    ['column' => 'application_uid'],
                                                    ['column' => 'site_uid'],
                                                    ['column' => 'data_uid'],
                                                    ['column' => 'status'],
                                                    ['column' => 'created'],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
                                ],
                            ],
                        ], // spa.spa-petitions.list
                    ], // route
                ], // Common\Handler\List
            ], // handler
        ];
    }
}
