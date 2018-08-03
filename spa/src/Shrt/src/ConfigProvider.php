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
                        "object" => \Shrt\Model\ShrtModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ],
            'handler' => [
                'Page\Handler\PageHandler'=> [
                    'route' => [
                        'shrt.home' => [
                            'get' => [
                                'method' => 'GET',
                                'scenario' => 'display',
                                'view_template_model' => [
                                    'layout' => 'layout::shrt-1',
                                    'template' => 'shrt::home-2018-a',
                                    'body_class' => 'app-action-home',
                                ],
                                'page_resource' => [
                                    [
                                        'type' => 'form',
                                        'name' => 'form_create_shrt',
                                        'spec' => [
                                            'type' => 'form-factory-filesystem',
                                            'service' => \Shrt\Form\ShortenForm::class,
                                        ],
//                                        'fieldset_user' => [
//                                            'fieldset_name' => 'fieldset_user',
//                                            'type' => 'fieldset',
//                                            'partial' => 'common-admin::template-read-item',
//                                            'service' => [
//                                                [
//                                                    'service_name'=>'User\TableService',
//                                                    'object' => \User\Model\UserModel::class,
//                                                    'method' => 'getItemByUid',
//                                                    'arguments' => [
//                                                        [
//                                                            'type' => 'service',
//                                                            'service_name' => \Common\Helper\CurrentRouteNameHelper::class,
//                                                            'method' => 'getMatchedParam',
//                                                            'arg_name' => 'uid',
//                                                        ],
//                                                    ],
//                                                ],
//
//                                            ],
//                                        ],
                                    ],
                                ],
                                'data_template_model' => [
                                    'route_name' => 'shrt.home',
                                    'heading' => [
                                        [
                                            'html_tag' => 'h1',
                                            'text' => 'User Details',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

    }
}
