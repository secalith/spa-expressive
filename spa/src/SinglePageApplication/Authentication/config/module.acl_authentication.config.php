<?php
return array(
    'acl' => array(
        'guest'=> array(
            'authentication',
            'authentication/login',
            'authentication/request',
        ),
        'admin'=> array(
            'authentication/logout',
        ),
    ),
    'application' => array(
        'acl' => array(
            'redirect_if_not_set' => true,
        ),
    ),
);