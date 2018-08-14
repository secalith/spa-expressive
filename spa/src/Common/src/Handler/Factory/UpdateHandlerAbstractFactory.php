<?php

declare(strict_types=1);

namespace Common\Handler\Factory;

use Common\Service\RouteConfigService;
use ArrayDigger\Service\ArrayDigger;
use Common\Handler\DataAwareInterface;
use Common\Handler\UpdateHandler;
use Common\Helper\CurrentRouteNameHelper;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UpdateHandlerAbstractFactory implements AbstractFactoryInterface
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
        if (fnmatch("*\Update", $requestedName) && ! class_exists($requestedName)) {
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
            $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

            $router   = $serviceLocator->get(RouterInterface::class);
            $template = $serviceLocator->has(TemplateRendererInterface::class)
                ? $serviceLocator->get(TemplateRendererInterface::class)
                : null;

            (is_null($template))??$template->addDefaultParam(\Zend\Expressive\Template\TemplateRendererInterface::TEMPLATE_ALL,'bodyClass','app-action-update');

            $urlHelper = $serviceLocator->get(UrlHelper::class);



            // get specification from CONFIG file
            $dataList = $this->arrayDigger->extractData($routeConfig,'data_template_model.main.list');

            foreach($dataList as $mainContentDeclaration)
            {

                $changed = [];

                foreach($mainContentDeclaration['read'] as $fieldsetConfig)
                {
                    if(array_key_exists('source',$fieldsetConfig))
                    {
                        foreach($fieldsetConfig['source']['service'] as $serviceConfig)
                        {
                            if($serviceLocator->has($serviceConfig['service_name']))
                            {
                                $requestedService = $serviceLocator->get($serviceConfig['service_name']);
                                if(method_exists($requestedService,$serviceConfig['method']))
                                {
                                    $argVal = [];
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

                                    $resources[$fieldsetConfig['fieldset_name']]['data'] = $requestedService->{$serviceConfig['method']}($argVal[0]);
                                    $resources[$fieldsetConfig['fieldset_name']]['service_config'] = $fieldsetConfig;

                                }
                            }
                        }
                    }
                }

                if( $mainContentDeclaration['type'] === 'form' && $resources !== null ) {
                    // load form
                    $form = new $mainContentDeclaration['object']();


                    $formData =[];
//                    $form->setData($resources);

                    foreach($resources as $resource) {
                        $formData[$form->getName()][$resource['service_config']['fieldset_name']] = $resource['data']->toArray();
                    }

                    if($form->get($resource['service_config']['base_fieldset_name'])
                        ->get($resource['service_config']['fieldset_name'])) {

                        $form->setData($formData);
//var_dump($formData);
                    }
                }

                if(array_key_exists('update',$mainContentDeclaration))
                {
                    $formName = $mainContentDeclaration['update']['form_name'];
                    if($requestMethod=='post') {

                        $form->setData($_POST);

                        if($form->isValid()) {

                            $formData = $form->getData();

                            $declaredFieldsets = $mainContentDeclaration['update']['data'];

                            foreach($declaredFieldsets as $fieldsetName=>$fieldsetDataDeclared)
                            {

                                if(property_exists($formData,$fieldsetName))
                                {
                                    $pData = $formData->{$fieldsetName};
                                    foreach($pData as $pDataName => $pDataValue)
                                    {
                                        if($pDataName=='created'||$pDataName=='updated') {
                                            continue;
                                        }
                                        if(null!==$resources[$fieldsetName]['data']->{$pDataName} && null!==$pDataValue) {
                                            if(strcmp($resources[$fieldsetName]['data']->{$pDataName},$pDataValue)) {
                                                $changed[$fieldsetName][$pDataName] = $pDataValue;
                                            }
                                        }elseif(null===$resources[$fieldsetName]['data']->{$pDataName} xor null===$pDataValue) {
                                         //   $changed[$fieldsetName][$pDataName] = $pDataValue;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if( ! empty($changed))
                {
                    foreach($mainContentDeclaration['update']['data'] as $fieldsetConfigName => $fieldsetConfig)
                    {
                        if(array_key_exists($fieldsetConfigName,$changed))
                        {
                            if(array_key_exists('service',$fieldsetConfig)) {
                                foreach($fieldsetConfig['service'] as $updateService) {
                                    foreach($updateService['arguments'] as $arg)
                                    {
                                        $argVal = [];

                                        if($arg['type'] == 'service')
                                        {
                                            if($serviceLocator->has($arg['service_name']))
                                            {
                                                $argService = $serviceLocator->get($arg['service_name']);
                                                $argVal[$arg['arg_name_target']] = $argService->{$arg['method']}($arg['arg_name']);
                                            }
                                        }
                                    }

                                    $requestedService = $serviceLocator->get($updateService['service_name']);

                                    $requestedService->{$updateService['method']}($argVal,$changed[$fieldsetConfigName]);


                                }
                            }
                        }
                    }
                }
            }


                $targetClass = new UpdateHandler(
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
