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

        return null;
    }
}