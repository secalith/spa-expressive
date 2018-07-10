<?php

declare(strict_types=1);

namespace User;

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
                'User\TableService' => [
                    'gateway' => [
                        'name' => 'User\TableGateway',
                    ],
                ],
                'User\Credentials\TableService' => [
                    'gateway' => [
                        'name' => 'User\Credentials\TableGateway',
                    ],
                ],
                'User\Profile\TableService' => [
                    'gateway' => [
                        'name' => 'User\Profile\TableGateway',
                    ],
                ],
            ], // table_service
            'gateway' => [
                'User\TableGateway' => [
                    'name' => 'User\TableGateway',
                    'table' => [
                        'name' => 'user',
                        'object' => \User\Model\UserTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \User\Model\UserModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'User\Credentials\TableGateway' => [
                    'name' => 'User\Credentials\TableGateway',
                    'table' => [
                        'name' => 'credentials',
                        'object' => \Auth\Model\CredentialsTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Auth\Model\CredentialsTableModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'User\Profile\TableGateway' => [
                    'name' => 'User\Profile\TableGateway',
                    'table' => [
                        'name' => 'user_profile',
                        'object' => \User\Model\UserProfileTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \User\Model\UserProfileModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                'Common\Handler\List'=> [
                    'route' => [
                        'spa.user.list' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'list',
                                'paginator' => [
                                    'object' => \Zend\Paginator\Paginator::class,
                                    'adapter' => [
                                        'object' => \Zend\Paginator\Adapter\DbSelect::class,
                                    ],
                                    'gateway' => 'User\TableGateway',
                                    'db_select' => [
                                        'columns' => ['uid','email','status','created',],
                                        'join' => [
                                            [
                                                'on' => 'user_profile',
                                                'where' => 'user_profile.uid = user.uid',
                                                'columns' => ['name_first','name_last',],
                                                'union' => 'left',
                                            ],
                                            [
                                                'on' => 'credentials',
                                                'where' => 'credentials.uid = user.uid',
                                                'columns' => ['pwd_updated' => 'updated',],
                                                'union' => 'left',
                                            ],
                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'spa.user.list',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Users',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.user.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'table' => [
                                        'main' => [
                                            'name' => 'main',
                                            'headers'=> [
                                                'name_first'=>'Name',
                                                'name_last'=>'Surname',
                                                'email'=>'Email',
                                                'status'=>'Status',
                                                'pwd_updated'=>'Password Updated',
                                                'created'=>'Created',
                                                100=>'Details',
                                            ],
                                            'rows' => [
                                                ['column'=>'name_first'],
                                                ['column'=>'name_last'],
                                                ['column'=>'email'],
                                                ['column'=>'status'],
                                                ['column'=>'pwd_updated'],
                                                ['column'=>'created'],
                                                ['buttons' => [
                                                    [
                                                        'html_tag' => 'a',
                                                        'text' => 'Details',
                                                        'attributes' => [
                                                            'class' => 'btn btn-sm btn-info ml-5',
                                                            'href' => [
                                                                'type' => 'plugin',
                                                                'name' => 'url',
                                                                'arguments' => [
                                                                    'spa.user.read',
                                                                    ['uid'=>"data::item=>uid"]
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    [
                                                        'html_tag' => 'a',
                                                        'text' => 'Delete',
                                                        'attributes' => [
                                                            'class' => 'btn btn-sm btn-warning ml-5',
                                                            'href' => [
                                                                'type' => 'plugin',
                                                                'name' => 'url',
                                                                'arguments' => [
                                                                    'spa.user.delete',
                                                                    ['uid'=>"data::item=>uid"]
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],],
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
//                                    'table_row' => 'restable-admin-client::table-row',
                                ],
                            ],
                        ], // spa.user.list
                    ], // route
                ], // Common\Handler\List
                'Common\Handler\Create' => [
                    'route' => [
                        'spa.user.create' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'spa.user.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Create User',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Users',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.user.list'
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
                                            'route' => 'spa.user.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \User\Form\UserWriteForm::class,
                                        'template' => 'common-admin::template-create',
                                    ]
                                ],
                            ],
                        ], // spa.user.create
                        'spa.user.create.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'data_template_model' => [
                                    'route_name' => 'spa.user.create',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Create Client',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Clients',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => 'helper::url:spa.user.list'
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
                                            'route' => 'spa.user.create.post',
                                        ],
                                        'object' => \User\Form\UserWriteForm::class,
                                        'save' => [
                                            'fieldset_user' => [
                                                'priority' => 100,
                                                'fieldset_name' => 'fieldset_user',
                                                'service' => [
                                                    [
                                                        'name'=>'User\TableService',
                                                        'object' => \User\Model\UserModel::class,
                                                        'method' => 'saveItem'
                                                    ],

                                                ],
                                            ],
                                            'fieldset_user_profile' => [
                                                'priority' => 110,
                                                'fieldset_name' => 'fieldset_user_profile',
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
                                                ],
                                            ],
                                            'fieldset_credentials' => [
                                                'priority' => 110,
                                                'fieldset_name' => 'fieldset_credentials',
                                                'service' => [
                                                    [
                                                        'name'=>'User\Credentials\TableService',
                                                        'object' => \User\Model\UserCredentialsModel::class,
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
                                                    ]
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // restable.admin.client.create.post
                    ],
                ], // Common\Handler\Create
                'Common\Handler\Delete' => [
                    'route' => [
                        'spa.user.delete' => [
                            'get' => [
//                                'method' => 'GET',
//                                'scenario' => 'create',
//                                'data_template_model' => [
//                                    'route_name' => 'spa.user.delete',
//                                    'heading' => [
//                                        [
//                                            'html_tag' => 'h1',
//                                            'text' => 'Delete User',
//                                            'buttons' => [
//                                                [
//                                                    'html_tag' => 'a',
//                                                    'text' => 'List Users',
//                                                    'attributes' => [
//                                                        'class' => 'btn btn-sm btn-info ml-5',
//                                                        'href' => 'helper::url:spa.user.list'
//                                                    ],
//                                                ],
//                                            ],
//                                        ],
//                                    ],
//                                ],
//                                'view_template_model' => [
//                                    'layout' => 'layout::default',
//                                    'template' => 'common-admin::template-create',
//                                    'forms' => [
//                                        'form_create' => 'common-admin::template-create',
//                                    ],
//                                ],
//                                'forms' => [
//                                    [
//                                        'action' => [
//                                            'route' => 'spa.user.delete.post',
//                                        ],
//                                        'name' => 'form_create',
//                                        'object' => \User\Form\UserDeleteForm::class,
//                                        'template' => 'common-admin::template-delete',
//                                    ]
//                                ],
                            ],
                        ], // spa.user.create
//                        'spa.user.delete.post' => [
//                            'post' => [
//                                'method' => 'POST',
//                                'scenario' => 'process',
//                                'data_template_model' => [
//                                    'route_name' => 'spa.user.delete',
//                                    'heading' => [
//                                        [
//                                            'html_tag' => 'h1',
//                                            'text' => 'Delete Client',
//                                            'buttons' => [
//                                                [
//                                                    'html_tag' => 'a',
//                                                    'text' => 'List Clients',
//                                                    'attributes' => [
//                                                        'class' => 'btn btn-sm btn-info ml-5',
//                                                        'href' => 'helper::url:spa.user.list'
//                                                    ],
//                                                ],
//                                            ],
//                                        ],
//                                    ],
//                                ],
//                                'view_template_model' => [
//                                    'layout' => 'layout::default',
//                                    'template' => 'common-admin::template-delete',
//                                    'forms' => [
//                                        'form_create' => 'restable-admin-client::form-delete',
//                                    ],
//                                ],
//                                'forms' => [
//                                    [
//                                        'name' => 'form_delete',
//                                        'action' => [
//                                            'route' => 'spa.user.delete.post',
//                                        ],
//                                        'object' => \User\Form\UserDeleteForm::class,
//                                        'save' => [
//                                            'fieldset_user' => [
//                                                'priority' => 100,
//                                                'fieldset_name' => 'fieldset_user',
//                                                'service' => [
//                                                    [
//                                                        'name'=>'User\TableService',
//                                                        'object' => \User\Model\UserModel::class,
//                                                        'method' => 'deleteItem'
//                                                    ],
//
//                                                ],
//                                            ],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ], // restable.admin.client.create.post
                    ],
                ], // Common\Handler\Delete
            ], // handler
        ];
    }
}
