<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use Common\Handler\DataAwareInterface;
use Common\Handler\ListHandler;
use Common\Helper\CurrentRouteNameHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListHandlerAbstractFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreate(\Interop\Container\ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreateServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    )
    {
        if (fnmatch("*\List", $requestedName) && ! class_exists($requestedName)) {
            $config = $serviceLocator->get('config');
            if(array_key_exists('app',$config)
                && array_key_exists('handler',$config['app'])
                && array_key_exists($requestedName,$config['app']['handler'])
            ) {
                $handlerConfig = $config['app']['handler'][$requestedName];
                $routeName = $serviceLocator->get(CurrentRouteNameHelper::class)->getMatchedRouteName();

                if(array_key_exists($routeName,$handlerConfig['route'])) {
                    return true;
                }
            }
        }
        return false;
    }

    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    ) {
        if ( ! class_exists($requestedName)) {

            $config = $serviceLocator->get('config');
            $handlerConfig = $config['app']['handler'][$name];

            $routeName = $serviceLocator->get(CurrentRouteNameHelper::class)->getMatchedRouteName();
            $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;

            $urlHelper = $serviceLocator->get(UrlHelper::class);

            if(array_key_exists($routeName,$handlerConfig['route'])){
                    if(array_key_exists($requestMethod,$handlerConfig['route'][$routeName])) {
                        $routeConfig = $handlerConfig['route'][$routeName][$requestMethod];
                        // load paginator
                        if(array_key_exists('paginator',$routeConfig)) {

                            $paginatorConfig = $routeConfig['paginator'];
                            // get table gateway
                            if( is_string($paginatorConfig['gateway'])
                                && $serviceLocator->has($paginatorConfig['gateway'])
                            ) {
                                $tableGateway = $serviceLocator->get($paginatorConfig['gateway']);
                                $sqlSelect = $tableGateway->getSql()->select();
                                $sqlSelectQuery = $paginatorConfig['db_select'];
                                $sqlSelect->columns($sqlSelectQuery['columns']);
                                if(array_key_exists('join',$sqlSelectQuery)) {
                                    foreach($sqlSelectQuery['join'] as $sqlJoin) {
                                        $sqlSelect->join($sqlJoin['on'],$sqlJoin['where'],$sqlJoin['columns'],$sqlJoin['union']);
                                    }
                                }

                                if(array_key_exists('where',$sqlSelectQuery)) {
                                    $sqlSelect->where($sqlSelectQuery['where']);
                                }

                                $paginator = new $paginatorConfig['object'](
                                    new $paginatorConfig['adapter']['object'](
                                        $sqlSelect,
                                        $tableGateway->getAdapter(),
                                        $tableGateway->getResultSetPrototype()
                                    )
                                );

                                $targetClass = new ListHandler(
                                    $router,
                                    $template,
                                    get_class($serviceLocator),
                                    $paginator,
                                    $urlHelper
                                );

                            }
                        } else {
                            $targetClass = new ListHandler(
                                $router,
                                $template,
                                get_class($serviceLocator),
                                null,
                                $urlHelper
                            );
                        }

                        // set LAYOUT and TEMPLATE
                        if(array_key_exists('view_template_model',$routeConfig) && $targetClass instanceof DataAwareInterface) {
                            $targetClass->addData($routeConfig['view_template_model'],'view_template_model');
                            if(array_key_exists('layout',$routeConfig['view_template_model'])) {
                                $targetClass->addData($routeConfig['view_template_model']['layout'],'layout');
                            }
                            if(array_key_exists('template',$routeConfig['view_template_model'])) {
                                $targetClass->addData($routeConfig['view_template_model']['template'],'template');
                            }
                        }
                        // set DATA-TABLE
                        if(array_key_exists('data_template_model',$routeConfig) && $targetClass instanceof DataAwareInterface) {
                            if(array_key_exists('table',$routeConfig['data_template_model'])) {
                                $targetClass->addData($routeConfig['data_template_model'],'data_template_model');
                            }
                        }

                        return $targetClass;
                    }
            }
        }

        return false;
    }
}
