<?php

namespace Common\DataSelector\Controller\Delegator;

use Common\Controller\Delegator\Delegator as CommonDelegator;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DataEntityDelegatorFactory extends CommonDelegator implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
        $parentLocator = $serviceLocator->getServiceLocator();
        $config = $parentLocator->get('config');
        // use route-service here in order to get odule name
        $commonRouteService = $parentLocator->get('commonRouteService');
        $commonDataSelectorService = $parentLocator->get('commonDataSelectorService');

        $routeSelectors = $commonDataSelectorService->getSelectorsConfig();

//        var_dump($routeSelectors);

        $routeName = $commonRouteService->getRouteName();
        $moduleName = $commonRouteService->getModuleName();
        $subModuleName = $commonRouteService->getSubmoduleName();
        $scenarioName = $commonRouteService->getScenario();

        // get data selector value per routename


        // add it to instance with addSelector()  as alias=>value

        // that value will be picked up in CommonReadDelegator

        return $targetInstance;
    }
}