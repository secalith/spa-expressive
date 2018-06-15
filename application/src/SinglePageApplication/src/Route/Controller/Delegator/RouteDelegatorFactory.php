<?php

namespace SinglePageApplication\Route\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Here we try to extract configuration from ['application']['module']['form']
 * and match the settings with form from formManager which name matches
 * <module>_<submodule>_<query> [i.e. authenticate_member_login]
 *
 * Class FormDelegatorFactory
 * @package Authentication\Member\Controller\Delegator
 */
class RouteDelegatorFactory implements DelegatorFactoryInterface
{

    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
        $parentLocator = $serviceLocator->getServiceLocator();
        // use route-service here in order to get odule name
        $commonRouteService = $parentLocator->get('commonRouteService');
        // set module, submodule and route per instance
        $targetInstance->setModuleName($commonRouteService->getModuleName());
        $targetInstance->setSubmoduleName($commonRouteService->getSubmoduleName());
        $targetInstance->setRouteName($commonRouteService->getRouteName());

        $route = $parentLocator->get('SinglePageApplication\Route\Model\RouteTable')->fetchBy($commonRouteService->getRouteName(),'route_name');

        $targetInstance->setRoute($route);

        return $targetInstance;
    }
}