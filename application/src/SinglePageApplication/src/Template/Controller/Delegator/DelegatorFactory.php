<?php

namespace SinglePageApplication\Template\Controller\Delegator;

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
            $item = $parentLocator->get('SinglePageApplication\Template\Model\Table')->fetchBy(
                $targetInstance->getPage()->getTemplate(),
                'uid'
            );
            $targetInstance->setTemplate($item);
        }

        return $targetInstance;
    }
}