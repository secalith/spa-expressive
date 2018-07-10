<?php
namespace Authentication\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Authentication\Service\AuthAdapter;
use Zend\Authentication\Storage;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;


/**
 * The factory responsible for creating of authentication service.
 */
class AuthenticationServiceFactory implements FactoryInterface
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

//        $dbAdapter           = $container->get('Application\Db\LocalAdapter');
//        $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter,
//            'user','email','password', 'MD5(?)');

        $authService = new AuthenticationService();
        $authService->setAdapter($authAdapter);
        $authService->setStorage($container->get(\Authentication\Model\AuthStorage::class));

        return $authService;



        // Create the service and inject dependencies into its constructor.
        return new AuthenticationService($authStorage, $authAdapter);
    }
}