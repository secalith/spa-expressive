<?php
namespace Auth\Service\Factory;

use Auth\Service\PasswordAdapter;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Auth\Service\AuthAdapter;
use Zend\Crypt\Password\Bcrypt;

/**
 * The factory responsible for creating of authentication service.
 */
class PasswordAdapterFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        // get User Gateway
        $userTable = $container->get("User\TableGateway");

        $adapter = new Bcrypt();
        return new PasswordAdapter($adapter);
    }
}