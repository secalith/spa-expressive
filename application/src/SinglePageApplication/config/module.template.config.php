<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Template\Model\Table' => 'SinglePageApplication\Template\Service\Factory\TableServiceFactory',
            'templateTableGateway' => 'SinglePageApplication\Template\Service\Factory\TableGatewayFactory',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'template' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'template',
                            ),
                        ),
                        'service_gateway' => 'templateTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'template' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'template',
                            ),
                        ),
                        'service_gateway' => 'templateTableGateway',
                    ),
                ),
            ),
        ),
    ),
);