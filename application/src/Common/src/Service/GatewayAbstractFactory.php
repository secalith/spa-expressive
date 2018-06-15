<?php

declare(strict_types=1);

namespace Common\Service;

use Zend\Hydrator\AbstractHydrator;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
//use Psr\Container\ContainerInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;

class GatewayAbstractFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        return $this->createServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreate(\Interop\Container\ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreateServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    ) {
        return (fnmatch('*\TableGateway', $requestedName));
    }

    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    ) {
        if ( ! class_exists($requestedName)) {

            $config = $serviceLocator->get('config');
            $gatewayConfig = $config['app']['gateway'][$name];

            $tableName = $gatewayConfig['table']['name'];
            $dbAdapterName = $gatewayConfig['adapter']['name'];
            $objectPrototype = $gatewayConfig['model']['object'];

            $dbHydratorName = $gatewayConfig['hydrator']['object'];

            if(fnmatch('*Mapper', $dbHydratorName)) {
                $map = $gatewayConfig['hydrator']['map'];
                $hydrator = new $dbHydratorName($map);
            } else {
                $hydrator = new $dbHydratorName();
            }

            $dbAdapter = $serviceLocator->get($dbAdapterName);

            $resultSet = new \Zend\Db\ResultSet\HydratingResultSet(
                $hydrator,
                new $objectPrototype()
            );

            return new TableGateway(
                $tableName,
                $dbAdapter,
                null,
                $resultSet
            );

        }

        return false;
    }
}