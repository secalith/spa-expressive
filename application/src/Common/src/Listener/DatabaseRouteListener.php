<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Route\Listener;

use Zend\Authentication\AuthenticationService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Filter\Word\UnderscoreToCamelCase;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Zend\Router\Http\Segment;

class DatabaseRouteListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    protected $routes;

    protected $sharedEvents;

    /**
     * {@inheritDoc}
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events, $priority = 1)
    {
        $this->sharedEvents = $events->getSharedManager();
        $this->listeners[] = $this->sharedEvents->attach(
            '*',
            'route',
            array($this, 'findRoute'),
            100000000
        );
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Check find Route in local Database
     *
     * @param MvcEvent $e
     * @return void
     */
    public function findRoute(MvcEvent $e)
    {
        $router = $e->getRouter();
        $filter = new UnderscoreToCamelCase();
        $children = null;
        if (null!==$this->routes) {
            foreach ($this->routes as $rd) {
                // create each route.
                $route = Segment::factory(
                    array(
                        'route' => $rd->getRoute(),
                        'defaults' => array(
                            'module' => $rd->getModule(),
                            'controller' => $filter->filter($rd->getController()),
                            'action' => $rd->getAction(),
                            'scenario' => $rd->getScenarioName(),
                            'submodule' => $rd->getSubmodule(),
                            'uid'=>'0',
                            'route_uid' => $rd->getUid(),
                        ),
                        'constraints' => array(
                            $rd->getConstraints()
                        ),
                        'may_terminate' => true,
                    )
                );
                $router->addRoute($rd->getName(), $route);
            }
        }

        return;
    }

    public function setRoutes($routes = null)
    {
        $this->routes = $routes;
    }
}
