<?php

declare(strict_types=1);

namespace Page\Handler;

use Common\Service\RouteConfigService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PageHandlerFactory
{

    private $requestedName = "Page\Handler\PageHandler";

    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

//        $config = $container->get(RouteConfigService::class);
//        $routeConfig = $config->getRouteConfig($this->requestedName);

        return new PageHandler($router, $template, get_class($container));
    }
}
