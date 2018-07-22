<?php
namespace Common\DataSelector\Service\Factory;

use Common\DataSelector\Service\DataSelectorService as RequestedService;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

/**
 * Class DataSelectorServiceFactory
 *
 * Set selectors_config from current <ns>_<sbns>.<scenario> config file
 *
 * It loads config from application/<ns>_<sbns>.<scenario>/view/data/selectors => eachitem/service mapped name
 * and loads the service by name recognized by the service manager
 *
 * @package Common\Service\Factory
 */
class DataSelectorServiceFactory implements FactoryInterface
{
    private $serviceLocator;

    /**
     * Makes use of service_name mapping more flexible.
     * Ideally it would be set in config.
     *
     * Service for the current Factory and the Instance may be different
     *
     * @var string
     */
    protected $service_map_name = "commonDataMapService";
    protected $service_map_name_instance = "commonDataMapService";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $instance = new RequestedService();
        // get global config
        $config = $serviceLocator->get('config');
        // get route info
        $routeMatch = $serviceLocator->get('Application')->getMvcEvent()->getRouteMatch();
        $routeName = $routeMatch->getMatchedRouteName();
        // get route name and scenario from 'common route service'
        $commonRoute = $serviceLocator->get('commonRouteService');
        // get view_page config per current <ns>_<sbns>.<scenario>
        $pageConfig = $commonRoute->getPageConfig();

        // get data selectors from config
        if(isset($pageConfig['data'],$pageConfig['data']['selectors'])) {
            if(null!==$pageConfig['data']['selectors']) {
                // set array of selectors available per current scenario
                $instance->setSelectorsConfig($pageConfig['data']['selectors']);
                // set Map Service
                $instance->setMapService($serviceLocator->get($this->getServiceMapName()));
                // load real service for every service requested in current scenario
                // then add (load-in) it to the instance
                foreach($instance->getSelectorsConfig() as $serviceName=>$serviceConfig) {
                    // get real service name. Name which will be recognised by serviceLocator
                    $realServiceName = $instance->getServiceMap()->getMapItem($serviceConfig['map_service']);
                    if($serviceLocator->has($realServiceName)) {
                        // set service per instance
                        $instance->addService($serviceLocator->get($realServiceName),$serviceConfig['map_service']);
                    }
                }
            }
        }
        //$routeConfig = $routeMatch->getParams();

        return $instance;
    }

    public function getServiceMapName()
    {
        return $this->service_map_name;
    }
}