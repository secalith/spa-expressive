<?php
namespace Common\DataMap\Service\Factory;

use Common\DataMap\Service\DataMapService as Service;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

/**
 * Matches the "application-configuration" keys into live services
 *
 *  $mapService = $this->serviceManager->get('commonMapService');
 *
 * Class MapServiceFactory
 * @package Common\Service\Factory
 */
class DataMapServiceFactory implements FactoryInterface
{
    protected $serviceManager;

    protected $formsConfig;

    protected $moduleNs;

    protected $language = "en_gb";

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceManager = $serviceLocator;

        $commonRouteService = $this->serviceManager->get('commonRouteService');
        $configService = $this->serviceManager->get('config');
        $configMap = $configService['application']['service']['commonDataMapSelector'];

        $instance = new Service();

        foreach($configMap['map_service'] as $serviceAlias=>$serviceName) {
            if("commonMapService"!==$serviceAlias) {
                $instance->addService($serviceLocator->get($serviceName),$serviceAlias);
            }
        }
        $instance->setMap($configMap);

        return $instance;
    }
}