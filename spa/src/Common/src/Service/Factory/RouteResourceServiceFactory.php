<?php

namespace Common\Service\Factory;

use Common\Service\RouteResourceService;
use Psr\Container\ContainerInterface;

class RouteResourceServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $handlersConfig = $config['app']['handler'];
       echo $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();
        $hostname = ($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:php_uname('n');
        /* @var \Instance\Model\InstanceModel $instance */
        $instance = $container->get("Instance\\TableService")->fetchBy(['hostname'=>$hostname]);
var_dump($instance);


        $pageData = $container->get("Page\\TableService")->fetchBy(['site_uid'=>$instance->getSiteUid()]);

        $pageResources = $container->get("PageResource\\TableService")->fetchBy(['hostname'=>$hostname]);

        return new RouteResourceService($handlersConfig,$currentRouteName,$instance);
    }
}