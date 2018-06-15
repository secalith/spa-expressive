<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Area\Model\Table' => 'SinglePageApplication\Area\Service\Factory\TableServiceFactory',
            'areaTableGateway' => 'SinglePageApplication\Area\Service\Factory\TableGatewayFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'singlepageapplication/area' => __DIR__ . '/../view/singlepageapplication/area.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'area' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'area',
                            ),
                        ),
                        'service_gateway' => 'areaTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'area' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'area',
                            ),
                        ),
                        'service_gateway' => 'areaTableGateway',
                    ),
                ),
            ),
        ),
    ),
);