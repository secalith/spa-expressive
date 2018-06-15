<?php
/* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace RestableAdmin\Listener\Factory;

use RestableAdmin\Listener\DatabaseRouteListener as RequestedService;
use Zend\ServiceManager\FactoryInterface as FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class DatabaseRouteListenerFactory implements FactoryInterface
{
    private $serviceLocator;

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createService($container);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $instance = new RequestedService();

        $cacheAdapter = null;

        $routes = $serviceLocator->get("RouteRoutes\\Table")
            ->fetchAllBy('0', 'parent_uid');

        foreach ($routes as $route) {
            $routesDB[$route->getName()] = $route;
            /*
            $children = $serviceLocator->get("RouteRoutes\\Table")
                ->fetchBy($route->getUid(), 'parent_uid');
            var_dump($children);
            if (null!==$children) {
                foreach ($children as $childRoute) {
                    $routesDB[$childRoute->getName()] = $childRoute;
                }
            }
            */
        }

        $instance->setRoutes($routesDB);

        return $instance;
    }
}
