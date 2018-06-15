<?php
namespace SinglePageApplication\Template\Service\Factory;

use SinglePageApplication\Template\Model\TemplateModel as Model;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class TableGatewayFactory implements FactoryInterface
{
    protected $identifier = "template";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Model());

        return new TableGateway($moduleConfig[$this->identifier]['database']['db']['table'], $dbAdapter, null, $resultSetPrototype);
    }
}