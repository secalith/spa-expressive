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

        if( ! isset($config['application']['route'][$routeNs])) {
            return $instance;
        }

        $routeModule = $config['application']['route'][$routeNs]['params']['module'];
        $routeSubmodule = strtolower($config['application']['route'][$routeNs]['params']['submodule']);
        $routeScenario = $config['application']['route'][$routeNs]['params']['scenario'];
        $moduleNs = strtolower(sprintf("%s_%s",$routeModule,$routeSubmodule));
        $scenarioNs = sprintf("%s.%s",$moduleNs,$routeScenario);

        // if configuration exists
        if(isset($config['application']['module'][$moduleNs][$routeSubmodule])) {
            $appRouteConfig = $config['application']['module'][$moduleNs][$routeSubmodule];

            $instance->setAppModuleRouteConfig($appRouteConfig);
            $instance->setModuleName($routeModule);
            $instance->setSubmoduleName($routeSubmodule);
            $instance->setScenario($routeScenario);
            $instance->setNamespace($moduleNs);
            if(isset($appRouteConfig['params']['additional'])) {
                $instance->setAdditionalModulesList($appRouteConfig['params']['additional']);
            }
            if(isset($appRouteConfig[$routeSubmodule]['scenario'][$scenarioNs]['page'])) {
                $pageConfig = $appRouteConfig[$routeSubmodule]['scenario'][$scenarioNs]['page'];
                $instance->setPageConfig($pageConfig);
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