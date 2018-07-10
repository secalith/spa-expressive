<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'SinglePageApplication\Page\Model\PageTable' => 'SinglePageApplication\Page\Service\Factory\PageTableServiceFactory',
            'pageTableGateway' => 'SinglePageApplication\Page\Service\Factory\PageTableGatewayFactory',
        ),
    ),
    'application' => array(
        'module' => array(
            'singlepageapplication_route' => array(
                'route' => array(
                    'page' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'page',
                            ),
                        ),
                        'service_gateway' => 'pageTableGateway',
                    ),
                ),
            ),
            'singlepageapplication_content' => array(
                'content' => array(
                    'page' => array(
                        'database' => array(
                            'db' => array(
                                'table' => 'page',
                            ),
                        ),
                        'service_gateway' => 'pageTableGateway',
                    ),
                ),
            ),
        ),
    ),
);