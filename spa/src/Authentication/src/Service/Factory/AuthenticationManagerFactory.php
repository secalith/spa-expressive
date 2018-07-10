<?php
namespace Authentication\Service\Factory;

use Interop\Container\ContainerInterface;
use Authentication\Service\AuthManager as AuthenticationManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Authentication\Service\AuthAdapter;

/**
 * The factory responsible for creating of authentication service.
 */
class AuthenticationManagerFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service
     * and returns its instance.
     */
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new SessionStorage('Zend_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(AuthAdapter::class);
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);
        // Create the service and inject dependencies into its constructor.
        return new AuthenticationManager($authStorage, $authAdapter,$authService);
    }
}