<?php
/* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Route\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouteDelegator implements DelegatorFactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        return $this->createDelegatorWithName($container, $name, $name, $callback);
    }

    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        /* @var $targetInstance \Route\PageViewAwareInterface */
        $targetInstance = $callback();
        $parentLocator = $serviceLocator;
        $commonRouteService = $parentLocator->get("Route\\Service");

        if (null==$commonRouteService->getRouteConfig()) {
            return $targetInstance;
        }
        // set module, submodule and route per instance
        $targetInstance->setModuleName($commonRouteService->getModuleName());
        $targetInstance->setSubmoduleName($commonRouteService->getSubmoduleName());
        $targetInstance->setRouteName($commonRouteService->getRouteName());

        $targetInstance->setRoute(
            $parentLocator->get("Route\\Table")
                ->fetchBy($commonRouteService->getRouteName(), 'route_name')
        );

        return $targetInstance;
    }
}
