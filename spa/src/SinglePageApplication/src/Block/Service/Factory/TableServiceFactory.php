<?php
namespace SinglePageApplication\Block\Service\Factory;

use SinglePageApplication\Block\Model\Table as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class TableServiceFactory implements FactoryInterface
{
    protected $identifier = "block";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();
        $tableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);

        $table = new Table($tableGateway);

        return $table;
    }
}