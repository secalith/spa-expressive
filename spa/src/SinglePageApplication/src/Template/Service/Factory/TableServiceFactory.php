<?php
namespace SinglePageApplication\Template\Service\Factory;

use SinglePageApplication\Template\Model\Table as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class TableServiceFactory implements FactoryInterface
{
    protected $identifier = "template";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();
        $tableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);

        $table = new Table($tableGateway);

        return $table;
    }
}