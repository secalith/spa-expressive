<?php

declare(strict_types=1);

namespace Shrt;

/**
 * The configuration provider for the Shrt module
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
                \Shrt\Form\ShortenForm::class => \Shrt\Form\Factory\ShortenFormFactory::class,
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
                'shrt'    => [__DIR__ . '/../templates/shrt'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Shrt\TableService' => [
                    'gateway' => [
                        'name' => 'Shrt\TableGateway',
                    ],
                ],
                'Shrt\Create\TableService' => [
                    'gateway' => [
                        'name' => 'Shrt\Create\TableGateway',
                    ],
                ],
                'Shrt\Create\Counter\TableService' => [
                    'gateway' => [
                        'name' => 'Page\Create\Counter\TableGateway',
                    ],
                ],
                'Shrt\Update\Counter\TableService' => [
                    'gateway' => [
                        'name' => 'Shrt\Update\Counter\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Shrt\TableGateway' => [
                    'name' => 'Shrt\TableGateway',
                    'table' => [
                        'name' => 'shrt',
                        'object' => \Shrt\Model\ShrtTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Shrt\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Shrt\Model\ShortenModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ],
            'handler' => [

                'Common\Handler\Create' => [
                    'route' => [
                        'shrt.home' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'create',
                                'data_template_model' => [
                                    'route_name' => 'shrt.home',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => _("Shorten your Link"),
                                        ],
                                    ], // heading
                                ],
                                'view_template_model' => [
                                    'layout' => 'layout::shrt-1',
                                    'template' => 'shrt::template-create',
                                    'template_class' => '',
                                    'forms' => [
                                        'form_create' => 'shrt::template-create-form',
                                    ],
                                ],
                                'forms' => [
                                    [
                                        'action' => [
                                            'route' => 'manager.petition.create.post',
                                        ],
                                        'name' => 'form_create',
                                        'object' => \Shrt\Form\ShortenForm::class,
                                        'template' => 'shrt::template-create',
                                    ]
                                ],
                            ],
                        ], // shrt.home
                        'shrt.home.post' => [
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
                        ], // shrt.home.post
                    ],
                ], // Common\Handler\Create

            ],
        ];

    }
}
