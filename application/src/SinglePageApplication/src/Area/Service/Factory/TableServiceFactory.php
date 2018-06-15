<?php
namespace SinglePageApplication\Area\Service\Factory;

use SinglePageApplication\Area\Model\Table as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class TableServiceFactory implements FactoryInterface
{
    protected $identifier = "area";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();
        $tableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);

        $table = new Table($tableGateway);

        return $table;
    }
}