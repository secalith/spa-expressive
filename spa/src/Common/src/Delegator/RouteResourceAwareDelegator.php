<?php

declare(strict_types=1);

namespace Common\Delegator;

use Common\Delegator\ApplicationFormRouteAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Common\Service\RouteConfigService;
use Zend\Expressive\Helper\UrlHelper;
use ArrayDigger\Service\ArrayDigger;

class RouteResourceAwareDelegator
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback)
    {
        $requestedCallback = $callback();
        $resources = [];

        $config = $container->get(RouteConfigService::class);
        $routeConfig = $config->getRouteConfig($name);

        if( array_key_exists('page_resource',$routeConfig))
        {
            #TODO: move to service

            foreach($routeConfig['page_resource'] as $specResource) {
                if( array_key_exists('spec',$specResource)
                    && array_key_exists('service',$specResource['spec']))
                {
                    foreach($specResource['spec']['service'] as $specService) {

                        $requestedService = $container->get($specService['service_name']);

                        if(method_exists($requestedService,$specService['method']))
                        {
                            if(array('arguments',$specService))
                            {
                                foreach($specService['arguments'] as $specServiceArg)
                                {
                                    if($specServiceArg['type'] == 'service')
                                    {
                                        if($container->has($specServiceArg['service_name']))
                                        {
                                            $argService = $container->get($specServiceArg['service_name']);
                                            $argVal[] = $argService->{$specServiceArg['method']}($specServiceArg['arg_name']);
                                        }
                                    }
                                }
                            }

                            $resources[$specResource['spec']['name']]['data'] = $requestedService->{$specService['method']}($argVal[0]);
                            $resources[$specResource['spec']['name']]['spec'] = $specService;

                        }

                    }
                }
            }
        }

        $requestedCallback->addRouteResource($resources,'resource');

        return $requestedCallback;

        var_dump($routeConfig['page_resource']);
        die();

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