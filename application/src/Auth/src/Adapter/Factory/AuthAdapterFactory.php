<?php

namespace Auth\Adapter\Factory;

use Auth\Adapter\AuthAdapter;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;

class AuthAdapterFactory
{
    public function __invoke(ContainerInterface	$container)
    {
        //	Retrieve	any	dependencies	from	the	container	when	creating	the	instance
        return new AuthAdapter();
    }
}