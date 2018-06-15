<?php
namespace SinglePageApplication\Content\Service\Factory;

use SinglePageApplication\Content\Model\ReadContentTable as Table;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class ReadTableServiceFactory implements FactoryInterface
{
    protected $identifier = "content";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();

        $tableGateway = $serviceLocator->get($moduleConfig[$this->identifier]['service_gateway']);

        $table = new Table($tableGateway);

        return $table;
    }
}