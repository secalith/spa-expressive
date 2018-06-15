<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Common\Settings\Model\Table' => 'Common\Settings\Service\Factory\TableServiceFactory',
            'settingsTableGateway' => 'Common\Settings\Service\Factory\TableGatewayFactory',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'settings' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'settings',
                            ),
                        ),
                        'service_gateway' => 'settingsTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'settings' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'settings',
                            ),
                        ),
                        'service_gateway' => 'settingsTableGateway',
                    ),
                ),
            ),
        ),
    ),
);