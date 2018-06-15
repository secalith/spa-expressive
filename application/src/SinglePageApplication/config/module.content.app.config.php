<?php
return array(
    'application' => array(
        'route' => array(
            'content_update' => array(
                'params' => array(
                    'module' => 'singlepageapplication',
                    'submodule' => 'content',
                    'scenario' => 'update',
                ),
            ),
        ), // route
        'module' => array(
            'singlepageapplication_content' => array(
                'content' => array(
                    'route' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'route',
                            ),
                        ),
                        'service_gateway' => 'routeTableGateway',
                    ), // route
                    'content' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'content',
                            ),
                        ),
                        'service_gateway' => 'contentTableGateway',
                        'scenario' => array(
                            'singlepageapplication_content.update' => array(
                                'acl' => array(),
                                'api' => array(),
                                'form' => array(
                                    'default' => array('update'),
                                ),
                                'form_view' => array(
                                    'default' => array(
                                        // if string then should be loaded from ZF's formElementManager
                                        // by name placed here [as ID]. otherwise set declaration here.
                                        'update' => 'singlepageapplication_content.update',
                                    ),
                                ),
                                'page' => array(
                                    'data' => array(
                                        'selectors' => array(
                                            'basic.uid' => array(
//                                                'service' => 'commonRouteService',
                                                'map_service' => 'route',
                                                'name' => 'uid',
                                            ),
                                        ),
                                    ), // data
                                ),
                            ), // singlepageapplication_content.update
                        ), // scenario
                    ), // content
                ), // content
            ),
            'singlepageapplication_route' => array(
                'route' => array(
                    'content' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'content',
                            ),
                        ),
                        'service_gateway' => 'contentTableGateway',
                    ),
                ),
            ),
        ), // module
    ), // application
);
