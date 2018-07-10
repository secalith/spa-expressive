<?php
namespace SinglePageApplication\Common\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Set properties like `module_name` or `submodule_name` per controller instance
 * It read data from $config['application'][<api>][<module>_<submodule>]
 *
 * Class InitialDelegatorFactory
 * @package Authentication\Member\Controller\Delegator
 */

class ReadDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @var string
     */
    private $module_name;
    /**
     * @var string
     */
    private $submodule_name;

    /**
     * @var object Common\Service\DataSelectorService
     */
    private $commonSelectorService;

    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
        $parentLocator = $serviceLocator->getServiceLocator();

        $readUid = $this->setSelectorService(
                $parentLocator->get('commonDataSelectorService')
            )->getSelectorValue('basic.uid');

        if(null!==$readUid) {
            $item = $parentLocator->get('SinglePageApplication\Content\Model\ReadContentTable')->fetchBy($readUid,'uid');
            if(null!==$item) {
                $targetInstance->setDataItem($item);
            }
        }

        return $targetInstance;
    }

    private function setSelectorService($service)
    {
        return $this->commonSelectorService = $service;
    }

    private function getSelectorService()
    {
        return $this->commonSelectorService;
    }
}