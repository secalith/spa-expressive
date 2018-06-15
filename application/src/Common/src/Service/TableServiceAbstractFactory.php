<?php

declare(strict_types=1);

namespace Common\Service;

//use Psr\Container\ContainerInterface;
use Cart\Service\CartService;
use Cart\Session\CartContainer;
use Common\Helper\RouteHelper;
use CurrencyExchange\Service\CurrencyExchangeService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TableServiceAbstractFactory implements AbstractFactoryInterface
{
    protected $identifier = "cart_item";

    /**
     * @var \Cart\Model\CartTable
     */
    protected $requestedTable = \Cart\Model\CartItemTable::class;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreate(\Interop\Container\ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreateServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    )
    {
        if (fnmatch('*\TableService', $requestedName)) {

            // Check if the Gateway Service is registered
            $resquestedNamespace = substr($requestedName, 0, strlen($requestedName) - strlen('TableService'));
            if ($serviceLocator->has($resquestedNamespace . "TableGateway")) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {

        if (!class_exists($requestedName)) {

            $config = $serviceLocator->get('config');

            $tableServiceConfig = $config['app']['table_service'][$name];

            if (array_key_exists('gateway', $tableServiceConfig)) {
                if (array_key_exists('name', $tableServiceConfig['gateway'])) {

                    $requestedGatewayName = $tableServiceConfig['gateway']['name'];

                    if ($serviceLocator->has($requestedGatewayName)) {
                        $requestedGateway = $serviceLocator->get($requestedGatewayName);
                        // obtain the config for the gateway.
                        if (array_key_exists($requestedGatewayName, $config['app']['gateway'])) {
                            // get the table model
                            $requestedTableModel = $config['app']['gateway'][$requestedGatewayName]['table']['object'];

                            return new $requestedTableModel($requestedGateway);

                        }
                    }
                }
            }
        }

        return false;
    }
}
