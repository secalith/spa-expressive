<?php

namespace Authorization\Middleware\Factory;

use Authorization\Helper\AuthorizationHelper;
use Authorization\Middleware\AuthorizationMiddleware;
use Psr\Container\ContainerInterface;

class AuthorizationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AuthorizationMiddleware(
            $container->get(AuthorizationHelper::class)
        );
    }
}