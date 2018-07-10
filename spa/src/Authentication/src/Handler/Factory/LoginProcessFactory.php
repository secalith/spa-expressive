<?php

namespace Authentication\Handler\Factory;

use Authentication\Handler\LoginProcessAction;
use Authentication\Service\AuthAdapter;
use Authentication\Service\AuthManager;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;

class LoginProcessFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        /* @var \Zend\Authentication\AuthenticationService $authService */
        $authService = $container->get(AuthenticationService::class);

//        if($authService->hasIdentity()) {
            var_dump($authService->getIdentity());
//        }

        $authManager = $container->get(AuthManager::class);

        $requestedService = new LoginProcessAction($router, $template, $authManager,$authService);

        return $requestedService;
    }
}
