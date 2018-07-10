<?php

namespace Authentication\Handler\Factory;

use Authentication\Handler\LogoutAction;
use Authentication\Service\AuthAdapter;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Db\Adapter\AdapterInterface;

class LogoutFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /* @var \Zend\Authentication\AuthenticationService $authService */
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);
//var_dump($authService->hasIdentity());
        if($authService->hasIdentity()) {
//            var_dump($authService->getIdentity());
        }

        $authManager = $container->get(\Auth\Service\AuthManager::class);

        $requestedService = new LogoutAction($router, $template, $authManager,$authService);

        return $requestedService;
    }
}
