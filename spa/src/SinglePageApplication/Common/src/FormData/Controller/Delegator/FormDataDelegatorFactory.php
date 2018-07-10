<?php

namespace Common\FormData\Controller\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FormDelegatorFactory
 * @package Common\Form\Controller\Delegator
 */
class FormDataDelegatorFactory implements DelegatorFactoryInterface
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
        $formElementManager = $parentLocator->get('formElementManager');



//        if form and dataItem are attached to controller try to bind both






        //$targetInstance->addForm(array('singlepageapplication_content.update'=>$form));

//        $itemsz = $parentLocator->get('Common\Settings\Model\Table')->fetchAll();
//        $items = null;
//        foreach($itemsz as $item) {
//            $items[$item->getName()] = $item;
//        }
//        $targetInstance->setSettings($items);

        return $targetInstance;
    }
}