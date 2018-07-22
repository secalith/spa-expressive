<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use ArrayDigger\Service\ArrayDigger;
use Common\Service\RouteConfigService;
use Common\Handler\DataAwareInterface;
use Common\Handler\DeleteHandler;
use Common\Helper\CurrentRouteNameHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Expressive\Template;


class DeleteHandlerAbstractFactory implements AbstractFactoryInterface
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
        if (fnmatch("*\Delete", $requestedName) && ! class_exists($requestedName)) {

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
        if ( ! class_exists($requestedName))
        {




            $handlerRouteConfig = $serviceLocator->get(\Common\Service\RouteConfigService::class)->getRouteConfig($requestedName);

            $config = $serviceLocator->get(RouteConfigService::class);
            $routeConfig = $config->getRouteConfig($name);

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;

            (is_null($template))??$template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'bodyClass','app-action-read');


            $urlHelper = $serviceLocator->get(UrlHelper::class);

            $dataView = $this->arrayDigger->extractData($routeConfig,'data_template_model.main.view');

            $routeName = $serviceLocator->get(CurrentRouteNameHelper::class)->getMatchedRouteName();

//            var_dumP($dataView);
//            var_dumP($routeConfig);

            $targetClass = new DeleteHandler(
                $router,
                $template,
                get_class($serviceLocator),
                $urlHelper
            );



            // set LAYOUT and TEMPLATE
            if(array_key_exists('view_template_model',$handlerRouteConfig) && $targetClass instanceof DataAwareInterface) {
                $targetClass->addData($handlerRouteConfig['view_template_model'],'view_template_model');
                if(array_key_exists('layout',$handlerRouteConfig['view_template_model'])) {
                    $targetClass->addData($handlerRouteConfig['view_template_model']['layout'],'layout');
                }
                if(array_key_exists('template',$handlerRouteConfig['view_template_model'])) {
                    $targetClass->addData($handlerRouteConfig['view_template_model']['template'],'template');
                }
            }
            // set DATA-TABLE
            if(array_key_exists('data_template_model',$handlerRouteConfig) && $targetClass instanceof DataAwareInterface) {
                $targetClass->addData($handlerRouteConfig['data_template_model'],'data_template_model');
            }

            return $targetClass;
        }

        return false;
    }
}
