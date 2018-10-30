<?php

declare(strict_types=1);

namespace Authorization\Helper\Factory;

use Authorization\Helper\AuthorizationHelper;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Helper\Exception\MissingRouterException;

class AuthorizationHelperFactory
{

    /**
     * @param ContainerInterface $container
     * @return CurrentRouteNameHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        // read RBAC config

        if (! $container->has('config')) {
            throw new MissingRouterException(
                'Config not found'
            );
        }

        return new AuthorizationHelper();
    }
}
