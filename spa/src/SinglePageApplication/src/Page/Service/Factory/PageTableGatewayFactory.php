<?php
namespace SinglePageApplication\Page\Service\Factory;

use SinglePageApplication\Page\Model\PageModel as Model;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class PageTableGatewayFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $moduleConfig = $serviceLocator->get("commonRouteService")->getAppModuleRouteConfig();

        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Model());

        return new TableGateway($moduleConfig['page']['database']['db']['table'], $dbAdapter, null, $resultSetPrototype);
    }
}