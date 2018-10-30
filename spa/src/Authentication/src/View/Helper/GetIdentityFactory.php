<?php

namespace Authentication\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetIdentityFactory extends AbstractHelper implements FactoryInterface
{
    private $sm;
    public function createService(ServiceLocatorInterface $serviceLocator){
    $this->sm = $serviceLocator;
    return $this;
}
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        $requestedService = new GetIdentity();
        $requestedService->authService = $authService;

        return $requestedService;
    }
}