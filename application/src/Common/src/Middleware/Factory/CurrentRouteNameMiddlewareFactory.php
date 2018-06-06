<?php

namespace Common\Middleware\Factory;

use Common\Helper\CurrentRouteNameHelper;
use Common\Middleware\CurrentRouteNameMiddleware;
use Psr\Container\ContainerInterface;

class CurrentRouteNameMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CurrentRouteNameMiddleware(
            $container->get(CurrentRouteNameHelper::class)
        );
    }
}