<?php

namespace Common\Service;

use ArrayDigger\Service\ArrayDigger;

class RouteResourceService
{
    public $handlersConfig;

    public $routeName;

    public $instance;

    public function __construct($handlersConfig,$routeName,$instance)
    {
        $this->handlersConfig = $handlersConfig;
        $this->routeName = $routeName;
        $this->instance = $instance;
    }

    public function getItemBySiteRoute($routeName)
    {

        var_dump($this->routeName);
        var_dump($routeName);
        var_dump($this->instance);
    }

    public function getRouteConfig($handlerName,$routeName=null,$requestMethod=null)
    {
        echo 8;
        $routeName = ($routeName) ?? $this->routeName;
        $requestMethod = ($requestMethod)?$requestMethod:strtolower($_SERVER['REQUEST_METHOD']);
        $arrayDigger = new ArrayDigger("^");
        $configPath = sprintf('%s^route^%s^%s',$handlerName,$routeName,$requestMethod);
        $config = $arrayDigger->extractData($this->handlersConfig,$configPath);

        if( null !== $config) {
            return $config;
        }
//        var_dump($this->handlersConfig);
//        var_dump($configPath);
//        var_dump($config);
        return null;
    }
}