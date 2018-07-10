<?php

namespace Authentication\Service\Factory;

use Common\Service\Factory\CommonServiceFactory;
use Authentication\Service\UserService as RequestedService;

class UserServiceFactory extends CommonServiceFactory
{

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->setRequestedService(new RequestedService());
        return parent::__invoke( $container, $requestedName, $options = null);
    }
    
}
