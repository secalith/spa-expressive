<?php
namespace Auth\Adapter\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Auth\Adapter\AuthenticationAdapter;
use Auth\Model\CredentialsTable;

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

        // get User Gateway
        $userTable = $container->get('User\TableGateway');
        $credentialsTable = $container->get('Auth\Credentials\TableGateway');


        return new AuthenticationAdapter($userTable,$credentialsTable);
    }
}