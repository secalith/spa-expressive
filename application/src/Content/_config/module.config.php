<?php
/**
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'service_manager' => array(
        'invokables' => array(
            'Content\Model' => 'Block\Content\Model',
        ),
        'factories' => array(
            "Content\\Table" => 'Content\Service\Factory\ContentTableServiceFactory',
            "Content\\Gateway" => 'Content\Service\Factory\ContentTableGatewayFactory',
        ),
    ),
    'application' => array(
        'route' => array(
            'content_update' => array(
                'params' => array(
                    'module' => 'content',
                    'submodule' => 'content',
                    'scenario' => 'update',
                ),
            ),
        ), // route
        'module' => array(
            'application' => [
                'application' => [
                    'content' => [
                        'database' => array(
                            'db' => array(
                                'table' => 'content',
                            ),
                        ),
                        'service_gateway' => "Content\\Gateway",
                    ],
                ],
            ],
            'content' => array(
                'content' => array(
                    'route' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'route',
                            ),
                        ),
                        'service_gateway' => 'Route\Service\TableGateway',
                    ), // route
                    'content' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'content',
                            ),
                        ),
                        'service_gateway' => 'Content\Service\TableGateway',
                        'scenario' => array(
                            'content.update' => array(
                                'acl' => array(),
                                'api' => array(),
                                'form' => array(
                                    'default' => array('content.update'),
                                ),
                                'form_view' => array(
                                    'default' => array(
                                        // if string then should be loaded from ZF's formElementManager
                                        // by name placed here [as ID]. otherwise set declaration here.
                                        'update' => 'content.update',
                                    ),
                                ),
                                'page' => array(
                                    'data' => array(
                                        'selectors' => array(
                                            'basic.uid' => array(
//                                                'service' => 'SinglePageApplication\Route\Service\Service',
                                                'map_service' => 'route',
                                                'name' => 'uid',
                                            ),
                                        ),
                                    ), // data
                                ),
                            ), /* content.update */
                        ), /* scenario */
                    ), /* content */
                ), /* content */
            ), /* content */
            'route' => array(
                'route' => array(
                    'content' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'content',
                            ),
                        ),
                        'service_gateway' => 'Content\Service\TableGateway',
                    ),
                ),
            ), /* route */
        ), /* module */
    ), /* application */
);
