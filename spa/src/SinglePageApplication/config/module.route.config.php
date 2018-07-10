<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Route\Model\RouteTable' => 'SinglePageApplication\Route\Service\Factory\RouteTableServiceFactory',
            'routeTableGateway' => 'SinglePageApplication\Route\Service\Factory\RouteTableGatewayFactory',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'route' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'route',
                            ),
                        ),
                        'service_gateway' => 'routeTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'route' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'route',
                            ),
                        ),
                        'service_gateway' => 'routeTableGateway',
                    ),
                ),
            ),
        ),
    ),
);