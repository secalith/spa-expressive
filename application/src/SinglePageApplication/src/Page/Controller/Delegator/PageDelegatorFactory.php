<?php

namespace SinglePageApplication\Page\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PageDelegatorFactory implements DelegatorFactoryInterface
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

        if(null!==$targetInstance->getRoute()) {
            // get page by route's UID
            $item = $parentLocator->get('SinglePageApplication\Page\Model\PageTable')->fetchBy(
                $targetInstance->getRoute()->getUid(),
                'route'
            );
            $targetInstance->setPage($item);
        }
        return $targetInstance;
    }
}