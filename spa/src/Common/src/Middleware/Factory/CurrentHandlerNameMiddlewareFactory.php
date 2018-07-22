<?php

namespace Common\Middleware\Factory;

use Common\Helper\CurrentHandlerNameHelper;
use Common\Middleware\CurrentRouteNameMiddleware;
use Psr\Container\ContainerInterface;

class CurrentHandlerNameMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CurrentRouteNameMiddleware(
            $container->get(CurrentHandlerNameHelper::class)
        );
    }
}