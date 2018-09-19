<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use ArrayDigger\Service\ArrayDigger;
use Common\Service\RouteConfigService;
use Common\Handler\DataAwareInterface;
use Common\Handler\ReadHandler;
use Common\Helper\CurrentRouteNameHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Expressive\Template;

class ReadHandlerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @var array
     */
    protected $routeConfig;

    /**
     * @var ArrayDigger
     */
    protected $arrayDigger;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreate(\Interop\Container\ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, $requestedName, $requestedName);
    }

    public function canCreateServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    )
    {
        if (fnmatch("*\Read", $requestedName) && ! class_exists($requestedName)) {
            $config = $serviceLocator->get(RouteConfigService::class);
            $routeConfig = $config->getRouteConfig($name);
            if( null !== $routeConfig)
            {
                // the config will be re-used
                $this->routeConfig = $routeConfig;
                $this->arrayDigger = $serviceLocator->get(ArrayDigger::class);

                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    ) {
        if ( ! class_exists($requestedName)) {

            $form = null;
            $resources = null;

            $config = $serviceLocator->get(RouteConfigService::class);
            $routeConfig = $config->getRouteConfig($name);

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;

            (is_null($template))??$template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'bodyClass','app-action-read');

            $urlHelper = $serviceLocator->get(UrlHelper::class);

            // obtain the details of requested entity
            $dataListDetails = $this->arrayDigger->extractData($routeConfig,'data_template_model.main.list-details');
            $listResources = [];

            foreach($dataListDetails as $mainContentDeclaration)
            {
                if(array_key_exists('read',$mainContentDeclaration) && $mainContentDeclaration['type']==='entity')
                {
                    foreach($mainContentDeclaration['read'] as $fieldsetConfig)
                    {
                        if(array_key_exists('service',$fieldsetConfig))
                        {
                            foreach($fieldsetConfig['service'] as $serviceConfig)
                            {
                                if($serviceLocator->has($serviceConfig['service_name']))
                                {
                                    $requestedService = $serviceLocator->get($serviceConfig['service_name']);
                                    if(method_exists($requestedService,$serviceConfig['method']))
                                    {
                                        $argVal =null;
                                        if(array('arguments',$serviceConfig))
                                        {
                                            foreach($serviceConfig['arguments'] as $arg)
                                            {
                                                if($arg['type'] == 'service')
                                                {
                                                    if($serviceLocator->has($arg['service_name']))
                                                    {
                                                        $argService = $serviceLocator->get($arg['service_name']);
                                                        if(array_key_exists('arg_name',$arg)) {
                                                            $argVal[] = $argService->{$arg['method']}($arg['arg_name']);
                                                        } else {
                                                            $argVal[] = $argService->{$arg['method']}();
                                                        }

                                                    }
                                                }
                                            }
                                        }

                                        if(count($argVal)==2) {
                                            $resources['list'][$mainContentDeclaration['name']][$fieldsetConfig['fieldset_name']]['data'] = $requestedService->{$serviceConfig['method']}($argVal[0],$argVal[1]);
                                        } else {
                                            $resources['list'][$mainContentDeclaration['name']][$fieldsetConfig['fieldset_name']]['data'] = $requestedService->{$serviceConfig['method']}($argVal[0]);
                                        }

                                        $resources['list'][$mainContentDeclaration['name']][$fieldsetConfig['fieldset_name']]['service_config'] = $fieldsetConfig;

                                    }
                                }
                            }
                        }
                    }
                }

            }


            $dataList2 = null;//$this->arrayDigger->extractData($routeConfig,'data_template_model.main.table-assoc');

            if(null!==$dataList2) {
                foreach($dataList2 as $mainContentDeclaration){
                    if(array_key_exists('service',$mainContentDeclaration)) {
                        foreach($mainContentDeclaration['service'] as $serviceConfig)
                        {
                            if($serviceLocator->has($serviceConfig['service_name']))
                            {
                                $requestedService = $serviceLocator->get($serviceConfig['service_name']);
                                $iRes=0;
                                if(method_exists($requestedService,$serviceConfig['method']))
                                {
                                    if(array('arguments',$serviceConfig))
                                    {
                                        foreach($serviceConfig['arguments'] as $arg)
                                        {
                                            if($arg['type'] == 'service')
                                            {
                                                if($serviceLocator->has($arg['service_name']))
                                                {
                                                    $argService = $serviceLocator->get($arg['service_name']);
                                                    $argVal[] = $argService->{$arg['method']}($arg['arg_name']);
                                                }
                                            }
                                        }
                                    }

                                    $resources[$mainContentDeclaration['name']][$iRes]['data'] = $requestedService->{$serviceConfig['method']}($argVal[0]);
                                    $resources[$mainContentDeclaration['name']][$iRes]['service_config'] = $serviceConfig;

                                    $tableResources[$mainContentDeclaration['name']][$iRes]['data'] = $requestedService->{$serviceConfig['method']}($argVal[0]);
                                    $tableResources[$mainContentDeclaration['name']][$iRes]['service_config'] = $serviceConfig;

                                    $iRes++;
                                }
                            }
                        }

                    }
                }
            }

            $targetClass = new ReadHandler(
                $router,
                $template,
                get_class($serviceLocator),
                $resources,
                $form,
                $urlHelper
            );

            // set LAYOUT and TEMPLATE
            if(array_key_exists('view_template_model',$routeConfig) && $targetClass instanceof DataAwareInterface) {
                $targetClass->addData($routeConfig['view_template_model'],'view_template_model');
                if(array_key_exists('layout',$routeConfig['view_template_model'])) {
                    $targetClass->addData($routeConfig['view_template_model']['layout'],'layout');
                }
                if(array_key_exists('template',$routeConfig['view_template_model'])) {
                    $targetClass->addData($routeConfig['view_template_model']['template'],'template');
                }
            }
            // set DATA-TABLE
            if(array_key_exists('data_template_model',$routeConfig) && $targetClass instanceof DataAwareInterface) {
                if(array_key_exists('main',$routeConfig['data_template_model'])) {
                    $targetClass->addData($routeConfig['data_template_model'],'data_template_model');
                }
            }

            return $targetClass;

        }

        return false;
    }
}
