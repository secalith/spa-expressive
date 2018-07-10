<?php

declare(strict_types=1);

namespace Authentication;

class ConfigProvider
{

    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'view_helpers' => [
                'factories' => [
                    'hasIdentity' => \Authentication\View\Helper\HasIdentityFactory::class,
                    'getIdentity' => \Authentication\View\Helper\GetIdentityFactory::class,
                ],
            ],
            'app' => $this->getApplicationConfig(),
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'auth' => [__DIR__ . '/../templates/auth'],
                'layout-auth' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                \Zend\Authentication\AuthenticationService::class
                    => Service\Factory\AuthenticationServiceFactory::class,
                Handler\LoginProcessAction::class => Handler\Factory\LoginProcessFactory::class,
                Handler\LogoutAction::class => Handler\Factory\LogoutFactory::class,
                Service\AuthAdapter::class => Service\Factory\AuthenticationAdapterFactory::class,
                Service\AuthManager::class => Service\Factory\AuthenticationManagerFactory::class,
                Model\AuthStorage::class => Model\AuthStorageFactory::class,
            ],
            'delegators' => [
//                \Auth\Handler\LoginProcessAction::class => [
//                    \Form\Delegator\FormDelegatorFactory::class,
//                    \Form\Delegator\FormFactoryDelegatorFactory::class,
//                ],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'gateway' => [
                'Authentication\User\TableGateway' => [
                    'name' => 'Authentication\User\TableGateway',
                    'table' => [
                        'name' => 'users',
                        'object' => \Authentication\Model\UserTable::class,
                    ],
                    'adapter' => [
                        'name' => 'Restable\Db\CredentialsAdapter',
                    ],
                    'model' => [
                        "object" => Model\UserModel::class,
                    ],
                    'hydrator' => [
                        "object" => \Zend\Hydrator\ObjectProperty::class,
                    ],
                ],
            ],
        ];
    }

}
