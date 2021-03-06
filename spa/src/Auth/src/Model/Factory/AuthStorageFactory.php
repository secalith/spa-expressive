<?php

declare(strict_types=1);

namespace Auth\Model\Factory;

use Auth\Model\AuthStorage;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * The factory responsible for creating of authentication service.
 */
class AuthStorageFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        return new AuthStorage('spa_auth');
    }
}