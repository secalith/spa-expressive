<?php

declare(strict_types=1);

namespace Auth;

/**
 * The configuration provider for the Auth module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app'    => $this->getApplicationConfig(),
            'view_helpers' => [
                'factories' => [
                    'hasIdentity' => \Auth\View\Helper\HasIdentityFactory::class,
                    'getIdentity' => \Auth\View\Helper\GetIdentityFactory::class,
                ],
            ],
            'rbac'=> [
                'roles' => [
                    'administrator' => [],
                    'editor' => ['administrator'],
                    'contributor' => ['editor'],
                    'guest' => [],
                ],
                'permissions' => [
                    'administrator' => [
                        'admin.settings',
                    ],
                    'editor' => [
                        'admin.publish',
                    ],
                    'contributor' => [
                        'admin.dashoard',
                        'admin.posts',
                    ],
                    'guest' => [],
                ],
            ],
            'authentication_config' => [
                'redirect' => [
                    'login' => [
                        'success' => 'spa.auth',
                        'error' => 'spa.auth.login',
                    ],
                    'logout' => [
                        'success' => 'home',
                        'error' => 'home',
                    ],
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                \Auth\Service\CredentialsManager::class => \Auth\Service\Factory\CredentialsManagerFactory::class,
                \Auth\Adapter\AuthenticationAdapter::class => \Auth\Adapter\Factory\AuthenticationAdapterFactory::class,
                \Auth\Handler\AuthHandler::class => \Auth\Handler\Factory\AuthHandlerFactory::class,
                \Auth\Handler\LoginHandler::class => \Auth\Handler\Factory\LoginHandlerFactory::class,
                \Auth\Handler\LogoutHandler::class => \Auth\Handler\Factory\LogoutHandlerFactory::class,
                \Auth\Handler\ResetCodeHandler::class => \Auth\Handler\Factory\ResetCodeHandlerFactory::class,
                \Auth\Handler\RequestHandler::class => \Auth\Handler\Factory\RequestHandlerFactory::class,
                \Auth\Model\AuthStorage::class => \Auth\Model\Factory\AuthStorageFactory::class,
//                \Auth\Model\CredentialsTable::class => \Auth\Model\Factory\CredentialsTableFactory::class,
                \Auth\Service\AuthenticationManager::class => Service\Factory\AuthenticationManagerFactory::class,
                \Zend\Authentication\AuthenticationService::class	=>	\Auth\Service\AuthenticationServiceFactory::class,
                \Auth\Service\PasswordAdapter::class => \Auth\Service\Factory\PasswordAdapterFactory::class,
                ],
            'delegators' => [
                // It is worth to remind that Delegators are loaded using FIFO method.
                Handler\LoginHandler::class => [
                    \Common\Delegator\ApplicationFormRouteAwareDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'auth'    => [__DIR__ . '/../templates/authentication'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'table_service' => [
                'Auth\Credentials\TableService' => [
                    'gateway' => [
                        'name' => 'Auth\Credentials\TableGateway',
                    ],
                ],
                'Auth\Credentials\Reset\TableService' => [
                    'gateway' => [
                        'name' => 'Auth\Credentials\Reset\TableGateway',
                    ],
                ],
            ],
            'gateway' => [
                'Auth\Credentials\TableGateway' => [
                    'name' => 'Auth\Credentials\TableGateway',
                    'table' => [
                        'name' => 'credentials',
                        'object' => \Auth\Model\CredentialsTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Auth\Model\CredentialsTableModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
                'Auth\Credentials\Reset\TableGateway' => [
                    'name' => 'Auth\Credentials\Reset\TableGateway',
                    'table' => [
                        'name' => 'credentials_reset',
                        'object' => \Auth\Model\CredentialsResetTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Application\Db\LocalSQLiteAdapter',
                    ],
                    'model' => [
                        "object" => \Auth\Model\CredentialsTableModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ], // gateway
        ];
    }
}
