<?php

declare(strict_types=1);

namespace PageResource\Delegator;

use PageResource\Delegator\PageResourceAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Common\Service\RouteConfigService;
use Zend\Expressive\Helper\UrlHelper;
use ArrayDigger\Service\ArrayDigger;

class PageResourceAwareDelegator
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback)
    {
        $requestedCallback = $callback();

        if( ! $requestedCallback instanceof PageResourceAwareInterface )
        {
            return $requestedCallback;
        }

        $resources = [];

        $config = $container->get(RouteConfigService::class);

        $routeConfig = $config->getRouteConfig($name);

        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();

        $hostname = ($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:php_uname('n');

        /* @var \Instance\Model\InstanceModel $instance */
        $instance = $container->get("Instance\\TableService")->fetchBy(['hostname'=>$hostname]);

        /* @var \Page\Model\PageModel $page */
        $page = $container->get("Page\\TableService")->fetchBy(
            [
                'name' => $currentRouteName,
                'site_uid' => $instance->getSiteUid(),
            ]
        );

        $currentLanguage = $container->get(\I18n\Service\I18n::class)->getCurrentLanguage();
        $defaultLanguage = $container->get(\I18n\Service\I18n::class)->getDefaultLanguage();

        $pageResources = $container->get("PageResource\\TableService")
            ->fetchAllBy([
                'site_uid'=>$instance->getSiteUid(),
                'page_uid'=>$page->getUid(),
            ]);

        if($pageResources->count() > 0)
        {
            /* @var \PageResource\Model\PageResourceModel $pageResource */
            foreach($pageResources as $pageResource)
            {
                $resource = [];
                switch($pageResource->getResourceType()) {

                    case 'petition':
                        $petition = [];
                        $resource = [];

                        // load petition
                        $petition['basic'] = $container->get("Petition\\TableService")->getItem($pageResource->getResourceUid());

                        $petition['translation'][$currentLanguage] = $container->get("Petition\\Translation\\TableService")
                            ->getItemByParentUidAndLanguage($pageResource->getResourceUid(),$currentLanguage);

                        if(empty($petition['translation'][$page->getLanguage()]) || false===$petition['translation'][$currentLanguage])
                        {
                            $petition['translation'][$defaultLanguage] = $container->get("Petition\\Translation\\TableService")
                                ->getItemByParentUidAndLanguage($pageResource->getResourceUid(),$defaultLanguage);
                        }

                        $resource[$pageResource->getResourceType()]['data'] = $petition;

                        $requestedCallback->addPageResource($resource,$pageResource->getResourceName());

                        break;
                    case 'form':

                        $resource = [];

                        if($container->has($pageResource->getResourceName())) {

                            $requestedForm = $container->get($pageResource->getResourceName());
                        } else {
                            $rname = $pageResource->getResourceName();
                            $requestedForm = new $rname();
                        }

                        $resource[$pageResource->getResourceType()]['service'] = null;
                        $resource[$pageResource->getResourceType()]['parameters'] = json_decode($pageResource->getParameters(),true);
                        $resource[$pageResource->getResourceType()]['data'] = $requestedForm;

                        if(null!==$resource[$pageResource->getResourceType()]['parameters']) {
                            if(array_key_exists('save',$resource[$pageResource->getResourceType()]['parameters'])) {
                                foreach($resource[$pageResource->getResourceType()]['parameters']['save'] as $saveService) {
                                    if(array_key_exists('service',$saveService)) {
                                        $serviceName = $saveService['service']['service_name'];
                                        $serviceMethodName = $saveService['service']['method_name'];
                                        if($container->has($serviceName)) {
                                            $service = $container->get($serviceName);
//                                            if(property_exists($service,$serviceMethodName)) {var_dump($service);die();
                                                $resource[$pageResource->getResourceType()]['service'][$serviceName]['service'] = $service;
                                                $resource[$pageResource->getResourceType()]['service'][$serviceName]['service_name'] = $serviceName;
                                                $resource[$pageResource->getResourceType()]['service'][$serviceName]['method_name'] = $serviceMethodName;
//                                            }
                                        }
                                    }
                                }
                            }
                        }

                        // OLD
//                        if(array_key_exists('parameters',$resource[$pageResource->getResourceType()])) {
//                            if(null!==$resource[$pageResource->getResourceType()]['parameters']) {
//                                if(array_key_exists('save',$resource[$pageResource->getResourceType()]['parameters'])) {
//                                    if(array_key_exists('service',$resource[$pageResource->getResourceType()]['parameters']['save'])) {
//                                        $serviceName = $resource[$pageResource->getResourceType()]['parameters']['save']['service'];
//                                        if($container->has($serviceName['name'])) {
//                                            $service = $container->get($serviceName['name']);
//                                            $resource[$pageResource->getResourceType()]['service'] = $service;
//                                        }
//                                    }
//                                }
//                            }
//                        }

                        $requestedCallback->addPageResource($resource,$pageResource->getResourceType());

                        break;
                }
            }

        }


        return $requestedCallback;

        die();
        if( ! empty($routeConfig) && array_key_exists('page_resource',$routeConfig))
        {
            #TODO: move to service

            // load Resources from Config
            foreach($routeConfig['page_resource'] as $specResource)
            {

                if( array_key_exists('spec',$specResource)
                    && array_key_exists('service',$specResource['spec'])
                )
                {

                    switch($specResource['spec']['type']) {

                        case 'page-resource':
                            foreach($specResource['spec']['service'] as $specService)
                            {

                                $requestedService = $container->get($specService['service_name']);
                                $requestedResourceType = $container->get($specService['type']);

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

                                                    if(array_key_exists('arg_name',$specServiceArg)) {
                                                        $argVal[] = $argService->{$specServiceArg['method']}($specServiceArg['arg_name']);
                                                    } else {
                                                        $argVal[] = $argService->{$specServiceArg['method']}();
                                                    }
                                                } else {
                                                    echo sprintf('the requested service does not exists. %s :: %s',get_class($specServiceArg['service_name']),$specService['method']);

                                                }
                                            } elseif($specServiceArg['type'] == 'form'){


                                            } else {
                                                echo sprintf('the requested service type does not exists. %s :: %s',get_class($requestedService),$specServiceArg['type']);
                                            }
                                        }
                                    }

                                    $resources[$specResource['spec']['name']]['data'] = $requestedService->{$specService['method']}($argVal[0]);
                                    $resources[$specResource['spec']['name']]['spec'] = $specService;

                                } else {
                                    echo sprintf('the requested method does not exists. %s :: %s',get_class($requestedService),$specService['method']);
                                }

                            }
                            break;
                        case 'form-factory-filesystem':

                            if( $container->has($specResource['spec']['service']) ) {
                                $resources[$specResource['name']]['object'] = $container->has($specResource['spec']['service']);
                                $resources[$specResource['name']]['spec'] = $specResource['spec'];
                            }

                            break;
                        default:
                            echo 'service type unknown';

                    }


                }
            }

            if( ! empty($resources)) {
                $requestedCallback->addPageResource($resources,'resource');
            }



        }

        return $requestedCallback;

        if( $requestedCallback instanceof ApplicationFormRouteAwareInterface )
        {
            if( ! empty($routeConfig['forms']))
            {

                foreach($routeConfig['forms'] as $formAppConfig)
                {
                    if( ! is_array($formAppConfig)) {

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