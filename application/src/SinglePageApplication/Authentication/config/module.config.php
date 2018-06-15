<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Authentication\Authentication\Index' => 'Authentication\Controller\IndexController',
            'Authentication\Authentication\Login' => 'Authentication\Controller\LoginController',
        ),
    ),
    'listeners' => array(
        'AuthenticationListener'
    ),
    'view_manager' => array(
        'template_map' => array(
            'layout/authentication'=> __DIR__ . '/../view/layout/layout',
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'authentication_login' => 'Authentication\Form\Form\LoginForm',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
        'invokables' => array(
            'AuthenticationListener' => 'Authentication\Listener\AuthenticationListener',
        ),
    ),
    'router' => array(
        'routes' => array(
            'authentication' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/authentication',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Authentication\Authentication',
                        'controller' => 'Login',
                        'action' => 'login',
                        'module' => 'authentication',
                        'form' => array(
                            'authentication_login',
                        ),
                    ),
                ), // options
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/login',
                            'defaults' => array(
                                // Change this value to reflect the namespace in which
                                // the controllers for your module are found
                                '__NAMESPACE__' => 'Authentication\Authentication',
                                'controller' => 'Login',
                                'action' => 'login',
                                'module' => 'authentication',
                                'form' => array(
                                    'authentication_login',
                                ),
                            ),
                        ), // options
                        'may_terminate' => true,
                    ),
                    'logout' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/logout',
                            'defaults' => array(
                                // Change this value to reflect the namespace in which
                                // the controllers for your module are found
                                '__NAMESPACE__' => 'Authentication\Authentication',
                                'controller' => 'Login',
                                'action' => 'logout',
                                'module' => 'authentication',
                                'form' => array(
                                    'authentication_login',
                                ),
                            ),
                        ), // options
                        'may_terminate' => true,
                    ),
                    'translation' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/translation/:language',
                            'defaults' => array(
                                // Change this value to reflect the namespace in which
                                // the controllers for your module are found
                                '__NAMESPACE__' => 'Authentication\Authentication',
                                'controller' => 'Index',
                                'action' => 'change-translation',
                                'language' => 'en-gb',
                            ),
                            'constraints' => array(
                                'subdomain' => '[az-AZ]',
                            ),
                        ), // options
                        'may_terminate' => true,
                    ),
                ),
            ),
            'account' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/account',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Authentication\Account',
                        'controller' => 'Index',
                        'action' => 'account',
                        'module' => 'authentication',
                        'submodule' => 'account',
                        'form' => array(
                            'authentication_account',
                        ),
                    ),
                ), // options
                'may_terminate' => true,
                'child_routes' => array(
                    'edit' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => 'edit',
                            'constraints' => array(
                                'page' => '[1-9][0-9]+',
                                'size' => '[0-9]+',
                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order' => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                // Change this value to reflect the namespace in which
                                // the controllers for your module are found
                                '__NAMESPACE__' => 'Authentication\Account',
                                'controller' => 'Index',
                                'action' => 'account',
                                'module' => 'authentication',
                                'submodule' => 'account',
                            ),
                        ), // options
                        'may_terminate' => true,
                    ), // list
                ),
            ),
        ),
    ),
    'api_endpoints' => array(
        'authentication' => array(
            'children' => array(
                'authentication_authentication' => array(
                    'routes' => array(
                        'login' => '/authenticate?profile',
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
                'text_domain' => __NAMESPACE__,
            ),
        ),
    ),
);
