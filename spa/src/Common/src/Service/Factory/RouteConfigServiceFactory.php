<?php

namespace Common\Service\Factory;

use Common\Service\RouteConfigService;
use Psr\Container\ContainerInterface;

class RouteConfigServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $handlersConfig = $config['app']['handler'];
        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();

        return new RouteConfigService($handlersConfig,$currentRouteName);
    }
}