<?php
namespace Authentication\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;

use Zend\Mvc\Router\Http\RouteMatch;

class AuthenticationListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    protected $sharedEvents;

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->sharedEvents = $events->getSharedManager();
        $this->listeners[] = $this->sharedEvents->attach(
        '*',
            'route',
            array($this, 'checkAcl'),
            -999
        );
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener)
        {
            if ($events->detach($listener))
            {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Check acl permissions for current request
     *
     * @param MvcEvent $e
     * @return void
     */
    public function checkAcl(MvcEvent $e)
    {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        $routerParams = $e->getRouteMatch()->getParams();
        $auth = new AuthenticationService();
        $config = $e->getApplication()->getServiceManager()->get('config');

        $this->initAcl($e);

        $userRole = 'guest';

        if ($auth->hasIdentity()) {
            $userRole = 'admin';
            $loggedInUser = $auth->getIdentity();
            $e->getViewModel()->loggedInUser = $loggedInUser;
        }

        $e->getViewModel()->userRole = $userRole;

        // check if route-acl is set
        if(isset($config['acl'],$config['acl'][$userRole])
            && in_array($route,$config['acl'][$userRole])) {
            if ( !$e->getViewModel()->acl->isAllowed($userRole, $route)) {
                // attach redirect on dispatch
                $this->setRedirectToLogin($e);
            }
        } else {
            $this->setRedirectToLogin($e);
        }

    }

    public function initAcl(MvcEvent $e) {

        $acl = new \Zend\Permissions\Acl\Acl();

        $config = $e->getApplication()->getServiceManager()->get('config');

        $roles = $config['acl'];
        $allResources = array();

        foreach ($roles as $role => $resources) {

            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl -> addRole($role);

            $allResources = array_merge($resources, $allResources);

            //adding resources
            foreach ($resources as $resource) {
                if(!$acl ->hasResource($resource))
                    $acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
            }
            //adding restrictions
            foreach ($allResources as $resource) {
                $acl->allow($role, $resource);
            }
        }
        //setting to view
        $e->getViewModel()->acl = $acl;

    }

    private function setRedirectToLogin(MvcEvent $e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller = $e->getTarget();

            $controller->plugin('redirect')->toRoute('authentication/login');

        }, 100);
        $e->stopPropagation();
    }
}