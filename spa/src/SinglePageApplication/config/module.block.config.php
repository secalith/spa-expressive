<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Block\Model\Table' => 'SinglePageApplication\Block\Service\Factory\TableServiceFactory',
            'blockTableGateway' => 'SinglePageApplication\Block\Service\Factory\TableGatewayFactory',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'block' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'block',
                            ),
                        ),
                        'service_gateway' => 'blockTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'block' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'block',
                            ),
                        ),
                        'service_gateway' => 'blockTableGateway',
                    ),
                ),
            ),
        ),
    ),
);