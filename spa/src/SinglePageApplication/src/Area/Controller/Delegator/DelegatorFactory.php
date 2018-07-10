<?php

namespace SinglePageApplication\Area\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DelegatorFactory implements DelegatorFactoryInterface
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
        if(null!==$targetInstance->getPage()) {
            // get page by route's UID
            $items = $parentLocator->get('SinglePageApplication\Area\Model\Table')->fetchAllBy(
                $targetInstance->getPage()->getTemplate(),
                'template'
            );

            $targetInstance->setArea($items);
        }

        return $targetInstance;
    }
}