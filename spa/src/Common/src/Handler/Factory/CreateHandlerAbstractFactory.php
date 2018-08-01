<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use ArrayDigger\Service\ArrayDigger;
use Common\Handler\DataAwareInterface;
use Common\Handler\CreateHandler;
use Common\Helper\CurrentRouteNameHelper;
use Common\Service\RouteConfigService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Expressive\Template;

class CreateHandlerAbstractFactory implements AbstractFactoryInterface
{
    protected $routeConfig;

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
        if (fnmatch("*\Create", $requestedName) && ! class_exists($requestedName))
        {
            $config = $serviceLocator->get(RouteConfigService::class);
            $routeConfig = $config->getRouteConfig($requestedName);

            if( ! empty($routeConfig))
            {
                $this->routeConfig = $routeConfig;

                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator, $name, $requestedName
    ) {
        if ( ! class_exists($requestedName))
        {

            $routeName = $serviceLocator->get(CurrentRouteNameHelper::class)->getMatchedRouteName();

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;
            // set LAYOUT and TEMPLATE
            if(array_key_exists('view_template_model',$this->routeConfig)) {
                // determine html body class
                if (array_key_exists('body_class', $this->routeConfig['view_template_model'])) {
                    $template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL, 'bodyClass', $this->routeConfig['view_template_model']['body_class']);
                }
            }

            $urlHelper = $serviceLocator->get(UrlHelper::class);

            $arrayDigger = new ArrayDigger();

            $targetClass = new CreateHandler(
                $router,
                $template,
                get_class($serviceLocator),
                $urlHelper,
                $this->routeConfig,
                $arrayDigger
            );

            // set LAYOUT and TEMPLATE
            if(array_key_exists('view_template_model',$this->routeConfig) && $targetClass instanceof DataAwareInterface) {
                $targetClass->addData($this->routeConfig['view_template_model'],'view_template_model');
                if(array_key_exists('layout',$this->routeConfig['view_template_model'])) {
                    $targetClass->addData($this->routeConfig['view_template_model']['layout'],'layout');
                }
                if(array_key_exists('template',$this->routeConfig['view_template_model'])) {
                    $targetClass->addData($this->routeConfig['view_template_model']['template'],'template');
                }

                if(array_key_exists('body_class',$this->routeConfig['view_template_model'])) {
                    $targetClass->addData($this->routeConfig['view_template_model']['template'],'template');
                }
            }
            // set DATA-TABLE
            if(array_key_exists('data_template_model',$this->routeConfig) && $targetClass instanceof DataAwareInterface)
            {
                $targetClass->addData($this->routeConfig['data_template_model'],'data_template_model');
            }

            return $targetClass;


        }

        return false;
    }
}
