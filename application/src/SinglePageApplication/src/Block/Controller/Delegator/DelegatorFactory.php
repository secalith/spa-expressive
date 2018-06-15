<?php

namespace SinglePageApplication\Block\Controller\Delegator;

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
        if(null!==$targetInstance->getArea()) {
            $items=null;
            foreach($targetInstance->getArea() as $area) {
                // get block by area UID
                $blockResult = $parentLocator->get('SinglePageApplication\Block\Model\Table')->fetchAllBy(
                    $area->getUid(),
                    'area'
                );

                $b = null;
                foreach($blockResult as $block) {
                    $targetInstance->setBlock($block);
                    $b[$block->getUid()] = $block;
                }

                $area->setBlock($b);

            }
        }
        return $targetInstance;
    }
}