<?php

declare(strict_types=1);

namespace Auth\Handler\Factory;

use Zend\Expressive\Helper\UrlHelper;
use Auth\Handler\ResetCodeHandler;
use	Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResetCodeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $authManager = $container->get(\Auth\Service\AuthenticationManager::class);

        $redirect_urls = [];
        $config = $container->get('config');
        $configRedirect = $config['authentication_config']['redirect']['login'];
        $urlHelper = $container->get(UrlHelper::class);
        foreach($configRedirect as $status => $redirect) {
            $redirect_urls[$status] = $urlHelper->generate($redirect);
        }

        return new ResetCodeHandler(
            $router,
            $template,
            get_class($container),
            $authManager,
            $redirect_urls
        );
    }
}