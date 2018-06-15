<?php
namespace SinglePageApplication\Route\Service\Factory;

use SinglePageApplication\Route\Model\RouteModel as Model;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class RouteTableGatewayFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Model());
//var_dump($moduleConfig['route']['database']['db']['table']);
        return new TableGateway($moduleConfig['route']['database']['db']['table'], $dbAdapter, null, $resultSetPrototype);
    }
}