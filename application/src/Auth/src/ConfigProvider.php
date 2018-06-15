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
                \Zend\Authentication\AuthenticationService::class	=>	\Auth\Service\AuthenticationServiceFactory::class,
                \Auth\Adapter\AuthAdapter::class => \Auth\Adapter\Factory\AuthAdapterFactory::class,
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
                'auth'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
