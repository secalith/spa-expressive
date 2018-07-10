<?php

namespace Authentication\Content\Controller\Delegator;

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
        if(null!==$targetInstance->getBlock()) {
            $items=null;
            foreach($targetInstance->getBlock() as $block) {
                // get page by route's UID
                $contentResult = $parentLocator->get(
                        'SinglePageApplication\Content\Model\ReadContentTable'
                    )->fetchAllBy(
                        $block->getUid(),
                        'block'
                    );

                $c = null;
                foreach($contentResult as $content) {
                    $targetInstance->setContent($content);
                    $c[$content->getUid()] = $content;
                }

                $block->setContent($c);

            }
        }
        return $targetInstance;
    }
}