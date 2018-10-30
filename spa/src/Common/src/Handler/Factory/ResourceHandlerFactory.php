<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use Common\Handler\ResourceHandler;
use	Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResourceHandlerFactory
{
    public function __invoke(ContainerInterface $container,$name,$re)
    {

        $handlerName = $container->get(\Common\Helper\CurrentHandlerNameHelper::class);
        $config = $container->get(\Common\Service\RouteConfigService::class);

        $routeConfig = $config->getRouteConfig();

        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new ResourceHandler(
            $router, $template, get_class($container)
        );
    }
}