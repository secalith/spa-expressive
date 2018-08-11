<?php

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class OpenTagHelperFactory extends AbstractHelper implements FactoryInterface
{
    private $sm;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
        return $this;
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $displayMode = 'display';

        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);
//
        if($authService->getIdentity()) {
            $displayMode = "edit";
        }

        return new OpenTagHelper($displayMode);
    }
}
