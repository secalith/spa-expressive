<?php
namespace SinglePageApplication\Page\Service\Factory;

use SinglePageApplication\Page\Model\PageTable as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class PageTableServiceFactory implements FactoryInterface
{
    protected $identifier = "page";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();
        $routeTableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);

        $table = new Table($routeTableGateway);

        return $table;
    }
}