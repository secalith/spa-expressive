<?php
return array(
    
    'api_endpoints' => array(
        'api_authentication' => array(
            'children' => array(
                'login' => '/authenticate',
                'login_profile' => '/authenticate?profile'
            ),
            'host' => array(
                'url' => 'http://app-ecancer-api',
            ),
        ),
        'headers' => array(
            'api_authentication' => array(
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CiCommon' => __DIR__ . '/../view',
            //'CiCommon\CiResource' => __DIR__ . '/../view/ci-resource',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'authentication_api' => 'Authentication\Client\ApiClient',
        ),
    ), // service manager
);
