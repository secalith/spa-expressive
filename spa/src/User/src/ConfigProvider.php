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
                'user-auth'    => [__DIR__ . '/../templates/user-auth/'],
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
                'User\OptIn\TableService' => [
                    'gateway' => [
                        'name' => 'User\OptIn\TableGateway',
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
                'User\OptIn\TableGateway' => [
                    'name' => 'User\OptIn\TableGateway',
                    'table' => [
                        'name' => 'user_optin',
                        'object' => \User\Model\UserOptInTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \User\Model\UserOptIn::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
            'handler' => [
                "Common\Handler\Read"=> [
                    'route' => [
                        'spa.user.read' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'details',
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-read',
                                    'body_class' => 'app-action-read',
                                ],
                                'page_resource' => [
                                    [
                                        'name' => 'main',
                                        'fieldset_user' => [
                                            'fieldset_name' => 'fieldset_user',
                                            'type' => 'fieldset',
                                            'partial' => 'common-admin::template-read-item',
                                            'service' => [
                                                [
                                                    'service_name'=>'User\TableService',
                                                    'object' => \User\Model\UserModel::class,
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
                                    'route_name' => 'spa.user.read',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'User Details',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Update User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.user.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_user.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:spa.user.create'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Users',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:spa.user.list'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_user',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'spa.user.read',
                                                ],
                                                'object' => \User\Form\UserReadForm::class,
                                                'read' => [
                                                    'fieldset_user' => [
                                                        'fieldset_name' => 'fieldset_user',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'User\TableService',
                                                                'object' => \User\Model\UserModel::class,
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
                                                    'fieldset_user_profile' => [
                                                        'fieldset_name' => 'fieldset_user_profile',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'service' => [
                                                            [
                                                                'service_name'=>'User\Profile\TableService',
                                                                'object' => \User\Model\UserProfileModel::class,
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
//                                                    'collection_contact' => [
//                                                        'fieldset_name' => 'collection_contact',
//                                                        'service' => [
//                                                            [
//                                                                'service_name'=>'RestableAdmin\Contact\TableService',
//                                                                'method' => 'getItemByClientUid',
//                                                                'arguments' => [
//                                                                    [
//                                                                        'type' => 'service',
//                                                                        'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
//                                                                        'method' => 'getMatchedParam',
//                                                                        'arg_name' => 'client_uid',
//                                                                    ],
//                                                                ],
//                                                            ],
//
//                                                        ],
//                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Common\Handler\Update'=> [
                    'route' => [
                        'spa.user.update' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'update',
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-update',
//                                    'table_row' => 'restable-admin-client::table-row',
                                ],
                                'data_template_model' => [
                                    'route_name' => 'spa.user.update',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'User Update',
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
                                                                'spa.user.read',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'fieldset_user.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Users',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-5',
                                                        'href' => 'helper::url:spa.user.list'
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Create User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-secondary ml-1',
                                                        'href' => 'helper::url:spa.user.create'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    'main' => [
                                        'list' => [
                                            [
                                                'name' => 'data_user',
                                                'type' => 'form',
                                                'action' => [
                                                    'route' => 'spa.user.read',
                                                ],
                                                'object' => \User\Form\UserReadForm::class,
                                                'read' => [
                                                    'fieldset_user' => [
                                                        'fieldset_name' => 'fieldset_user',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'User\TableService',
                                                                    'object' => \User\Model\UserModel::class,
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
                                                    'fieldset_user_profile' => [
                                                        'fieldset_name' => 'fieldset_user_profile',
                                                        'type' => 'fieldset',
                                                        'partial' => 'common-admin::template-read-item',
                                                        'source' => [
                                                            'service' => [
                                                                [
                                                                    'service_name'=>'User\Profile\TableService',
                                                                    'object' => \User\Model\UserProfileModel::class,
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
//                                                    'collection_contact' => [
//                                                        'fieldset_name' => 'collection_contact',
//                                                        'service' => [
//                                                            [
//                                                                'service_name'=>'RestableAdmin\Contact\TableService',
//                                                                'method' => 'getItemByClientUid',
//                                                                'arguments' => [
//                                                                    [
//                                                                        'type' => 'service',
//                                                                        'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
//                                                                        'method' => 'getMatchedParam',
//                                                                        'arg_name' => 'client_uid',
//                                                                    ],
//                                                                ],
//                                                            ],
//
//                                                        ],
//                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
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
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.user.create',
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
                                                        [
                                                            'html_tag' => 'a',
                                                            'text' => 'Update',
                                                            'attributes' => [
                                                                'class' => 'btn btn-sm btn-default ml-5',
                                                                'href' => [
                                                                    'type' => 'plugin',
                                                                    'name' => 'url',
                                                                    'arguments' => [
                                                                        'spa.user.update',
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
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-list',
                                    'body_class' => 'app-action-list',
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
                                            'fieldset_user_optin' => [
                                                'priority' => 110,
                                                'fieldset_name' => 'fieldset_user_optin',
                                                'service' => [
                                                    [
                                                        'name'=>'User\OptIn\TableService',
                                                        'object' => \User\Model\UserOptIn::class,
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
                                        ],
                                    ],
                                ],
                            ],
                        ], // restable.admin.client.create.post


                        // manager.register
                        'manager.register' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'register',
                                'data_template_model' => [
                                    'route_name' => 'manager.register.post',
                                    'heading' => [
                                        // will be parsed inside ./templates/common-manager/common-manager-partial.phtml
                                        [
                                            'html_tag' => 'h1',
                                            'html_tag_class' => 'display-1',
                                            'text' => _('Sign up to Art13.eu'),
                                            'wrapper_class' => 'text-center pb-2 mb-3 mt-5',
                                        ],
                                        [
                                            'html_tag' => 'h2',
                                            'text' => _('Creating your account will only take a few seconds, and you\'ll get complete access to Art13.eu free - no obligations.'),
                                            'wrapper_class' => 'text-center pb-2 mb-3 mt-4',
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::art13-1',
                                    'template' => 'user-auth::register',
                                    'body_class' => 'action-register',
                                    'forms' => [
                                        'form_create' => 'user-auth::register-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.register',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \User\Form\RegisterForm::class,
                                        'template' => 'user-auth::form-register',
                                    ]
                                ],
                            ],
                        ], // spa.user.create
                        'manager.register.post' => [
                            'post' => [
                                'method' => 'POST',
                                'scenario' => 'process',
                                'http_redirect' => [
                                    'success' => '/login',
                                    'error' => null,
                                ],
                                'data_template_model' => [
                                    'route_name' => 'manager.register.post',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'html_tag_class' => 'display-1',
                                            'text' => _('Sign up to Art13.eu'),
                                            'wrapper_class' => 'text-center pb-2 mb-3 mt-5',
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::art13-1',
                                    'template' => 'user-auth::register',
                                    'body_class' => 'action-register',
                                    'forms' => [
                                        'form_create' => 'user-auth::register-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'name' => 'form_create',
                                        'action' => [
                                            'route' => 'manager.register.post',
                                        ],
                                        'object' => \User\Form\RegisterForm::class,
                                        'save' => [
                                            'data' => [
                                                'fieldset_user' => [
                                                    'fieldset_name' => 'fieldset_user',
                                                    'service' => [
                                                        [
                                                            'name'=>'User\TableService',
                                                            'object' => \User\Model\UserModel::class,
                                                            'method' => 'saveItem'
                                                        ],

                                                    ],
                                                ], // fieldset_user
                                                'fieldset_user_profile' => [
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
                                                ], // fieldset_user_profile
                                                'fieldset_credentials_password' => [
                                                    'fieldset_name' => 'fieldset_credentials_password',
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
                                                                'source_name' => 'fieldset_credentials_password',
                                                                'source_field_name' => 'password',
                                                            ],
                                                            'adapter' => [
                                                                'object' => \Auth\Service\PasswordAdapter::class,
                                                                'method' => 'create',
                                                            ],
                                                        ]
                                                    ],
                                                ], // fieldset_credentials_password
                                                'fieldset_user_optin' => [
                                                    'fieldset_name' => 'fieldset_user_optin',
                                                    'service' => [
                                                        [
                                                            'name'=>'User\OptIn\TableService',
                                                            'object' => \User\Model\UserOptIn::class,
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
                                'method' => 'GET',
                                'scenario' => 'delete',
                                'data_template_model' => [
                                    'route_name' => 'spa.user.delete',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'Delete User',
                                            'buttons' => [
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'List Users',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.user.list',
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'User Details',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.user.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'user.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'html_tag' => 'a',
                                                    'text' => 'Update User',
                                                    'attributes' => [
                                                        'class' => 'btn btn-sm btn-info ml-5',
                                                        'href' => [
                                                            'type' => 'plugin',
                                                            'name' => 'url',
                                                            'arguments' => [
                                                                'spa.user.update',
                                                                [
                                                                    'uid' => [
                                                                        'source' => 'data-resource',
                                                                        'property_path' => 'user.data.uid',
                                                                        'property_path_delimiter' => '.',
                                                                    ],
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ], // heading
                                    'main' => [
                                        'forms' => [
                                            'form_delete' => [
                                                'name'=>'form_delete',
                                                'data_map' => [
                                                    'application_id' => 'spa',
                                                    [
                                                        'field_path'=>'form_delete.fieldset_user.uid',
                                                        'field_path_delimiter' => '.',
                                                        'type' => 'data-resource',
                                                        'source_path'=>'user.data.uid',
                                                        'source_path_delimiter'=>'.',
                                                    ],
                                                ],
                                            ],
                                        ],
                                        'view' => [
                                            [
                                                'type' => 'question',
                                                'question' => _("Are you sure to remove user %s"),
                                                'rewrite' => [
                                                    'fieldset_user.email'
                                                ],
                                            ],
                                            [
                                                'type' => 'answer',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'form_delete.fieldset_user.confirmation',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'form_delete.fieldset_user.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'form_delete.fieldset_user.uid',
                                                'form_element_path_delimiter' => '.',
                                            ],
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'application_id',
                                            ],
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'csrf',
                                            ],
                                            [
                                                'type' => 'form-element',
                                                'form' => 'form_delete',
                                                'form_element_path' => 'submit',
                                            ],
                                        ],
                                    ],
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::default',
                                    'template' => 'common-admin::template-delete',
                                    'forms' => [
                                        'form_create' => 'common-admin::template-delete',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'spa.user.delete',
                                        ],
                                        'name' => 'form_delete',
                                        'object' => \User\Form\UserDeleteForm::class,
                                        'template' => 'common-admin::template-delete',
                                    ]
                                ],
                                'data' => array(
                                    'selectors' => array(
                                        'user.uid' => array(
                                            'map_service' => 'route',
                                            'name' => 'uid',
                                        ),
                                    ),
                                ), // data
                                'page_resource' => [
                                    [
                                        'name' => 'main',
                                        'spec' => [
                                            'name' => 'user',
                                            'type' => 'fieldset',
                                            'service' => [
                                                [
                                                    // Obtain the data from DB
                                                    'type' => 'database',
                                                    'service_name'=>'User\TableService',
                                                    // Bind data to Model
                                                    'object' => \User\Model\UserModel::class,
                                                    'method' => 'getItemByUid',
                                                    'arguments' => [
                                                        [
                                                            // Get the UID value from the URL
                                                            'type' => 'service',
                                                            // Which Service should be used to obtain the data
                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
                                                            // Method to obtain the value
                                                            'method' => 'getMatchedParam',
                                                            // property name
                                                            'arg_name' => 'uid',
                                                        ],
                                                    ],
                                                ],

                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ], // spa.user.delete
                    ],
                ], // Common\Handler\Delete
            ], // handler
        ];
    }
}
