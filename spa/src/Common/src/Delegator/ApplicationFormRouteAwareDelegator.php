<?php

declare(strict_types=1);

namespace Common\Delegator;

use Common\Delegator\ApplicationFormRouteAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Common\Service\RouteConfigService;
use Zend\Expressive\Helper\UrlHelper;
use ArrayDigger\Service\ArrayDigger;

class ApplicationFormRouteAwareDelegator
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback)
    {
        $requestedCallback = $callback();

        $config = $container->get(RouteConfigService::class);
        $routeConfig = $config->getRouteConfig($name);

        if( $requestedCallback instanceof ApplicationFormRouteAwareInterface )
        {
            if( ! empty($routeConfig['forms']))
            {
                var_dump($routeConfig['forms']);
                foreach($routeConfig['forms'] as $formAppConfig)
                {
                    if( ! is_array($formAppConfig)) {
                        var_dump($formAppConfig);
                    }
                    if( array_key_exists('object',$formAppConfig))
                    {
                        /* @var \Zend\Form\Form $form */
                        $form = new $formAppConfig['object']();
                    } elseif(array_key_exists('form_factory',$formAppConfig)) {
                        if($container->has($formAppConfig['form_factory']))
                        {
                            $form = $container->get($formAppConfig['form_factory']);
                        } else {
                            echo 'dupa';
                            die();
                        }
                    }

                    $formIndexName = (array_key_exists('name',$formAppConfig))
                        ? $formAppConfig['name']
                        : $form->getName()
                        ;

                    // check if the action is defined
                    if($formAppConfig['action']) {
                        if(array_key_exists('route',$formAppConfig['action'])) {
                            $urlHelper = $container->get(UrlHelper::class);
                            $form->setAttribute('action',$urlHelper->generate($formAppConfig['action']['route']));
                        } elseif(array_key_exists('url',$formAppConfig['action'])) {
                            $form->setAttribute('action',$formAppConfig['action']['url']);
                        }
                    }
                    $requestedCallback->addRouteForm($form,$formIndexName);
                }
            }
        }

        return $requestedCallback;

    }
}