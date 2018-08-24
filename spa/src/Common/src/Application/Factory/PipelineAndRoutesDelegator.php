<?php

namespace Common\Application\Factory;

use Common\Helper\RouteHelperMiddleware as RouteHelperMiddleware;

//use Navigation\Navigation;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitOptionsMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\Middleware\MethodNotAllowedMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\ZendView\UrlHelper;

class PipelineAndRoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param string $name
     * @param callable $callback
     * @param array|null $options
     * @return callable|mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var $app Application */
        $app = $callback();

        // Setup pipeline:
        $app->pipe(ErrorHandler::class);
        $app->pipe(ServerUrlMiddleware::class);
        $app->pipe(RouteMiddleware::class);
        $app->pipe(ImplicitHeadMiddleware::class);
        $app->pipe(ImplicitOptionsMiddleware::class);
        $app->pipe(MethodNotAllowedMiddleware::class);
        $app->pipe(UrlHelperMiddleware::class);
        $app->pipe(\I18n\Handler\I18n::class);
        $app->pipe(\Common\Middleware\CurrentRouteNameMiddleware::class);
        $app->pipe(DispatchMiddleware::class);
        $app->pipe(NotFoundHandler::class);



        // Prototypying
        // obtain licence number?
        #TODO: use middleware for it
        $hostname = (array_key_exists('HTTP_HOST',$_SERVER) && $_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:php_uname('n');
        if($hostname==='www.art13.eu' || $hostname==='art13.eu'){
            header("Location: http://stopacta2.pl");
            die();
        }

        /* @var \Instance\Model\InstanceModel $instance */
        $instance = $container->get("Instance\\TableService")->fetchBy(['hostname'=>$hostname]);



        if( $instance !== false ) {
            // obtain Routes from database
            # TODO Use middleware for it
            # TODO cache here
            $items = $container->get("PageRoute\\RouterEntry\\TableService")->fetchItemBy(
                [
                    'application_uid' => $instance->getApplicationUid(),
                    'site_uid' => $instance->getSiteUid(),
                ]
            );

            if( $items !== false) {
                /* @var $item \PageRoute\Model\RouterEntryModel */
                foreach($items as $item) {
                    switch($item->getController())
                    {
                        case '\Page\Handler\PageHandler':
                            $app->{$item->getMethod()}($item->getRouteUrl(), [\Page\Handler\PageHandler::class], $item->getRouteName());
                            break;
                        default:
                            $app->{$item->getMethod()}($item->getRouteUrl(), $item->getController(), $item->getRouteName());
                            break;
                    }
                }
            }

        } else {
            echo 'instance not found.';
        }


        return $app;
    }
}