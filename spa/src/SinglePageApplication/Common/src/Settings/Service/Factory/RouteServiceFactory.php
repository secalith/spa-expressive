<?php
namespace Common\Route\Service\Factory;

use Common\Route\Service\RouteService as RequestedService;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class RouteServiceFactory implements FactoryInterface
{
    private $serviceLocator;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $instance = new RequestedService();
        // get global config
        $config = $serviceLocator->get('config');
        // get route info
        $routeMatch = $serviceLocator->get('Application')->getMvcEvent()->getRouteMatch();
        $routeName = $routeMatch->getMatchedRouteName();
        $instance->setRouteName($routeName);

        $routeConfig = $routeMatch->getParams();

        $routeNs = $instance->getRouteNameReFormatted();
        $routeModule = $config['application']['route'][$routeNs]['params']['module'];
        $routeSubmodule = $config['application']['route'][$routeNs]['params']['submodule'];
        $moduleNs = sprintf("%s_%s",$routeModule,$routeSubmodule);
        
        // if configuration exists
        if(isset($config['application']['module'][$moduleNs][$routeNs])) {
            $appRouteConfig = $config['application']['module'][$moduleNs][$routeNs];



            $instance->setAppModuleRouteConfig($appRouteConfig);
            $instance->setModuleName($appRouteConfig['params']['module']);
            $instance->setSubmoduleName($appRouteConfig['params']['submodule']);
            $instance->setScenario($appRouteConfig['params']['scenario']);
            $instance->setNamespace($moduleNs);
            if(isset($appRouteConfig['params']['additional'])) {
                $instance->setAdditionalModulesList($appRouteConfig['params']['additional']);
            }
            // include view_page config if is present in config
            if(isset($appRouteConfig['view'],$appRouteConfig['view']['page'])) {
                $instance->setViewPageConfig($appRouteConfig['view']['page']);
            }
        }
        $instance->setRouteConfig($routeConfig);

        return $instance;
    }
}