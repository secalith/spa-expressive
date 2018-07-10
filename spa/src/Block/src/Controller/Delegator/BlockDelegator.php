<?php
/**
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Block\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockDelegator implements DelegatorFactoryInterface
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        return $this->createDelegatorWithName($container, $name, $name, $callback);
    }

    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
        $parentLocator = $serviceLocator;
        if (null!==$targetInstance->getArea()) {
            $items=null;
            foreach ($targetInstance->getArea() as $area) {
                $blockResult = $parentLocator->get("Block\\Table")->fetchAllBy(
                    $area->getUid(),
                    'area'
                );
                $b = null;
                if(null!==$blockResult) {
                    foreach ($blockResult as $block) {
                        $targetInstance->setBlock($block);
                        $b[$block->getUid()] = $block;
                    }
                    $area->setBlock($b);
                }
            }
        }
        return $targetInstance;
    }
}
