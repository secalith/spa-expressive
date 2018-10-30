<?php

declare(strict_types=1);

namespace Common\Helper\Factory;

use Common\Helper\CurrentRouteNameHelper;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Helper\Exception\MissingRouterException;

class CurrentRouteNameHelperFactory
{

    /**
     * @param ContainerInterface $container
     * @return CurrentRouteNameHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        if (! $container->has(RouterInterface::class)) {
            throw new MissingRouterException(sprintf(
                '%s requires a %s implementation; none found in container',
                RouteHelper::class,
                RouterInterface::class
            ));
        }

        return new CurrentRouteNameHelper($container->get(RouterInterface::class));
    }
}
