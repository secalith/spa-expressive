<?php
namespace Auth\Service\Factory;

use Auth\Adapter\AuthenticationAdapter;
use Auth\Service\CredentialsManager;
use Interop\Container\ContainerInterface;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;

/**
 * The factory responsible for creating of authentication service.
 */
class CredentialsManagerFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {

        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new \Auth\Model\AuthStorage('Zend_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(AuthenticationAdapter::class);
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        $userTable = $container->get("User\\TableService");
        $credentialsTable = $container->get("Auth\\Credentials\\TableService");
        $credentialsResetTable = $container->get("Auth\\Credentials\\Reset\\TableService");

        // Create the service and inject dependencies into its constructor.
        return new CredentialsManager($userTable, $credentialsTable, $credentialsResetTable);
    }
}