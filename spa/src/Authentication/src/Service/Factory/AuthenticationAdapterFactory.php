<?php
namespace Authentication\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Authentication\Service\AuthAdapter;

/**
 * The factory responsible for creating of authentication service.
 */
class AuthenticationAdapterFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        // Create the service and inject dependencies into its constructor.

        // get User Gateway
        $userTable = $container->get("Authentication\User\TableGateway");


        return new AuthAdapter($userTable);
    }
}