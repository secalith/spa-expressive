<?php

declare(strict_types=1);

namespace Common\Middleware\Factory;

use Common\Middleware\CurrentUrlMiddleware;
use Common\View\Helper\CurrentUrlHelper;
use Psr\Container\ContainerInterface;

class CurrentUrlMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CurrentUrlMiddleware(
            $container->get(CurrentUrlHelper::class)
        );
    }
}