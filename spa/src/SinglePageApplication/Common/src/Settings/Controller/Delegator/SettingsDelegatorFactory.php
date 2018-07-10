<?php

namespace Common\Settings\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SettingsDelegatorFactory implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
        $parentLocator = $serviceLocator->getServiceLocator();
        $config = $parentLocator->get('config');
        // use route-service here in order to get odule name
        $commonRouteService = $parentLocator->get('commonRouteService');

        $itemsz = $parentLocator->get('Common\Settings\Model\Table')->fetchAll();
        $items = null;
        foreach($itemsz as $item) {
            $items[$item->getName()] = $item;
        }
        $targetInstance->setSettings($items);

        return $targetInstance;
    }
}