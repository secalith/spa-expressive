<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Router\Middleware\MethodNotAllowedMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

/**
 * Setup middleware pipeline:
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    // @see /Common/Application/FactoryPipelineAndRoutesDelegator
    // it is overwritten in commons config file so any changes made here take no effect.
};
