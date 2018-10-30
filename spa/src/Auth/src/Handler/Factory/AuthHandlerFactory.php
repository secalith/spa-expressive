<?php

declare(strict_types=1);

namespace Auth\Handler\Factory;

use	Auth\Adapter\AuthAdapter;
use Auth\Handler\AuthHandler;
use	Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new AuthHandler(
            $router, $template, get_class($container),
            $container->get(AuthenticationService::class)
        );
    }
}