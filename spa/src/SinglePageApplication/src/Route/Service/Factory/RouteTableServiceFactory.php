<?php
namespace SinglePageApplication\Route\Service\Factory;

use SinglePageApplication\Route\Model\RouteTable as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class RouteTableServiceFactory implements FactoryInterface
{
    protected $identifier = "route";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();
        $routeTableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);
        $table = new Table($routeTableGateway);
        return $table;

    }
}