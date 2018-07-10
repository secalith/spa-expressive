<?php

namespace Common\DataSelector\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DataSelectorService implements FactoryInterface
{
    /**
     * @var string $route_name
     */
    private $_route_name;

    /**
     * @var array $route_config
     */
    private $_route_config;

    /**
     * Keeps configuration for scenario and serviceMap
     *
     * @var
     */
    private $_selectors_config;

    /**
     * @var
     */
    private $_serviceMap;

    public function createService (ServiceLocatorInterface $serviceLocator)
    {
        return $this;
    }

    public function setRouteName($route_name)
    {
        $this->_route_name = $route_name;
        return $this;
    }

    public function getRouteName()
    {
        return $this->_route_name;
    }

    public function getRouteNameReFormatted($from="/",$to=".")
    {
        $route_name = str_replace($from,$to,$this->_route_name);
        return $route_name;
    }

    public function setRouteConfig($route_config=null)
    {
        $this->_route_config = $route_config;
        return $this;
    }

    public function getRouteConfig()
    {
        return $this->_route_config;
    }

    public function getModuleName()
    {
        return $this->_module_name;
    }

    public function getSubmoduleName()
    {
        return $this->_submodule_name;
    }

    public function getNamespace()
    {
        $r = sprintf("%s_%s",$this->getModuleName(),$this->getSubmoduleName());
        return $r;
    }

    /**
     * @return array
     */
    public function getAdditionalModulesList()
    {
        return $this->_additional_modules_list;
    }

    /**
     * @param array $additional_modules_list
     * @return $this
     */
    public function setAdditionalModulesList($additional_modules_list)
    {
        $this->_additional_modules_list = $additional_modules_list;
        return $this;
    }

    public function setSelectorsConfig($selectors_config=null)
    {
        $this->_selectors_config = $selectors_config;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelectorsConfig()
    {
        return $this->_selectors_config;
    }

    /**
     * @param null $selector_name
     * @return mixed
     */
    public function getSelectorValue($selector_name=null)
    {
        if( isset($selector_name)&&is_string($selector_name)
            &&isset($this->_selectors_config[$selector_name])) {
                // check what is the source of quantifier
               $requestedServiceName = $this->_selectors_config[$selector_name]['map_service'];
                switch($requestedServiceName) {
                    // search value source and call from appropiate [mapped] service
                    case 'route':
                        // check if the common route service is included in mapping
                        $requestedService = $this->getService($requestedServiceName);
                        $paramName = $this->_selectors_config[$selector_name]['name'];

                        return $requestedService->getParam($paramName);

                        break;
                }
        }
        return null;
    }

    /**
     * @param $service
     * @return $this
     */
    public function setMapService($service)
    {
        $this->_serviceMap = $service;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceMap()
    {
        return $this->_serviceMap;
    }

    /**
     * @param $service
     * @param null $service_name
     * @return $this
     */
    public function addService($service,$service_name=null)
    {
        $this->_serviceMap->addService($service,$service_name);
        return $this;
    }

    /**
     * @param null $service_name
     * @return mixed
     */
    public function getService($service_name=null)
    {
        return $this->_serviceMap->getService($service_name);
    }
}