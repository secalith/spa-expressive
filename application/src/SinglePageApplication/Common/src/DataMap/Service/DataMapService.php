<?php

namespace Common\DataMap\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DataMapService implements FactoryInterface
{
    /**
     *
     * @var array
     */
    private $map;

    private $services;

    private $language = "en_gb";

    /**
     * Constructor
     */
    public function __construct($config = [])
    {
        
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return $this
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this;
    }

    /**
     * @param null $map
     * @return $this
     */
    public function setMap($map = null)
    {
        $this->map = $map;
        return $this;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     *
     * @deprecated uSE getService() instead
     *
     * @param null $name
     * @return null|string
     */
    public function getMapItem($service_name=null)
    {
        if( null!==$service_name
            &&is_array($this->map['map_service'])
            &&isset($this->map['map_service'][$service_name])) {
                return $this->map['map_service'][$service_name];
        }
        return null;
    }

    /**
     * @param null $map
     * @return $this
     */
    public function setServices($services = null)
    {
        $this->services = $services;
        return $this;
    }

    /**
     * Get service by reference name.
     *
     * @param null $service_name
     * @return null
     */
    public function getService($service_name=null)
    {
        if( null!==$service_name
            &&is_array($this->map['service'])
            &&isset($this->map['service'][$service_name])) {
            return $this->map['service'][$service_name];
        }
        return null;
    }

    public function addService($service,$service_name=null)
    {
        $this->map['service'][$service_name] = $service;
    }
}