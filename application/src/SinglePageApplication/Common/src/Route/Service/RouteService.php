<?php

namespace Common\Route\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouteService implements FactoryInterface
{
    /**
     *
     * @var string
     */
    private $route_name;

    /**
     * @var array
     */
    private $route_config;

    /**
     * @var array
     */
    private $page_config;

    /**
     * @var array
     */
    private $additional_modules_list;

    /**
     * @var array
     */
    private $app_module_route_config;

    /**
     *
     * @var string
     */
    private $module_name;

    /**
     *
     * @var string
     */
    private $submodule_name;

    /**
     * Holds the [current] scenario name
     *
     * @var string
     */
    private $scenario;

    /**
     * Holds name of full [config] namespace
     * in format <module_name>_<submodule_name>.<scenario>
     *
     * @var string
     */
    private $namespace;

    private $page_view_config;

    private $view_page_config;

    /**
     * Constructor
     */
    public function __construct($config=[])
    {
        //$this->name = $config['name'];
    }

    public function createService (ServiceLocatorInterface $serviceLocator)
    {
        return $this;
    }

    public function setRouteName($route_name)
    {
        $this->route_name = $route_name;
        return $this;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function getRouteNameReFormatted($from="/",$to=".")
    {
        $route_name = str_replace($from,$to,$this->route_name);
        return $route_name;
    }

    public function setRouteConfig($route_config=null)
    {
        $this->route_config = $route_config;
        return $this;
    }

    public function getRouteConfig()
    {
        return $this->route_config;
    }

    public function setAppModuleRouteConfig($data)
    {
        $this->app_module_route_config = $data;
        return $this;
    }

    public function getAppModuleRouteConfig($location=null)
    {
        return $this->app_module_route_config;
    }

    public function setModuleName($module_name=null)
    {
        $this->module_name = $module_name;
        return $this;
    }

    public function getModuleName()
    {
        return $this->module_name;
    }

    public function setPageViewConfig($pageViewConfig=null)
    {
        $this->page_view_config = $pageViewConfig;
        return $this;
    }

    public function getPageViewConfig()
    {
        return $this->page_view_config;
    }

    public function setPageConfig($pageConfig=null)
    {
        $this->page_config = $pageConfig;
        return $this;
    }

    public function getPageConfig()
    {
        return $this->page_config;
    }

    public function setSubmoduleName($submodule_name=null)
    {
        $this->submodule_name = $submodule_name;
        return $this;
    }

    public function getSubmoduleName()
    {
        return $this->submodule_name;
    }

    public function setNamespace($namespace=null)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return array
     */
    public function getAdditionalModulesList()
    {
        return $this->additional_modules_list;
    }

    /**
     * @param array $additional_modules_list
     * @return RouteService
     */
    public function setAdditionalModulesList($additional_modules_list)
    {
        $this->additional_modules_list = $additional_modules_list;
        return $this;
    }

    public function setViewPageConfig($view_page_config=null)
    {
        $this->view_page_config = $view_page_config;
        return $this;
    }

    public function getViewPageConfig()
    {
        return $this->view_page_config;
    }

    public function setScenario($scenario=null)
    {
        $this->scenario = $scenario;
        return $this;
    }

    public function getScenario()
    {
        return $this->scenario;
    }

    public function getParams()
    {
        return $this->route_config;
    }

    public function getParam($param_name)
    {
        return (isset($this->route_config[$param_name]))
            ? $this->route_config[$param_name]
            : null;
    }
}