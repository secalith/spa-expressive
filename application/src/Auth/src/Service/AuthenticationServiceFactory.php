<?php

declare(strict_types=1);

namespace Auth\Service;

use Auth\Adapter\AuthAdapter;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AuthenticationService(
            null,
            $container->get(AuthAdapter::class)
        );
    }
}