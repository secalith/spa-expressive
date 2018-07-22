<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use ArrayDigger\Service\ArrayDigger;
use Common\Handler\DataAwareInterface;
use Common\Handler\ListHandler;
use Common\Helper\CurrentRouteNameHelper;
use Common\Service\PaginatorQueryService;
use Common\Service\RouteConfigService;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListHandlerAbstractFactory implements AbstractFactoryInterface
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
        if (fnmatch("*\List", $requestedName) && ! class_exists($requestedName))
        {
            // Load the config by the Handler name and the (current) Route name
            $config = $serviceLocator->get(RouteConfigService::class);
            $routeConfig = $config->getRouteConfig($name);
            if( null !== $routeConfig) {
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

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;
            (is_null($template))??$template->addDefaultParam(\Zend\Expressive\Template\TemplateRendererInterface::TEMPLATE_ALL,'bodyClass','app-action-list');

            $urlHelper = $serviceLocator->get(UrlHelper::class);

            /** @var \Zend\Paginator\Paginator|null $paginator */
            $paginator = (!array_key_exists('paginator',$this->routeConfig)
                    && $serviceLocator->has($this->routeConfig['paginator']['gateway'])
                )
                ? null
                : $serviceLocator->get(PaginatorQueryService::class)
                    ->setTableGateway($serviceLocator->get($this->routeConfig['paginator']['gateway']))
                    ->makeQuery($this->routeConfig['paginator'])
                ;

            $targetClass = new ListHandler(
                $router,
                $template,
                get_class($serviceLocator),
                $paginator,
                $urlHelper
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
            }

            // set DATA-TABLE
            if($targetClass instanceof DataAwareInterface) {
                $data_template_model = $this->arrayDigger->extractData($this->routeConfig, 'data_template_model.main.table','.');
                if ($data_template_model !== null) {
                    $targetClass->addData($this->routeConfig['data_template_model'], 'data_template_model');
                }
            }

            return $targetClass;

        }

        return false;
    }
}
