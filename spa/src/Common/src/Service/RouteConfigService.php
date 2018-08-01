<?php

namespace Common\Service;
use ArrayDigger\Service\ArrayDigger;

/**
 *
 * Class RouteConfigService
 * @package Common\Service
 */
class RouteConfigService
{
    public $handlersConfig;

    public $routeName;

    public function __construct($handlersConfig,$routeName)
    {
        $this->handlersConfig = $handlersConfig;
        $this->routeName = $routeName;
    }

    public function getRouteConfig($handlerName,$routeName=null,$requestMethod=null)
    {
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