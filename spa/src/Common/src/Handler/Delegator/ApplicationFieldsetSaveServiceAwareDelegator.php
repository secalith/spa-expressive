<?php

declare(strict_types=1);

namespace Common\Handler\Delegator;

use Common\Handler\ApplicationConfigAwareInterface;
use Common\Handler\ApplicationFormAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

/**
 * Load services which will be used to save data from form to db.
 * The data is structured in config in the `forms` index in the app/route
 * Retireve data (services) sin halder
 *
 * Class ApplicationFieldsetSaveServiceAwareDelegator
 * @package Common\Handler\Delegator
 */
class ApplicationFieldsetSaveServiceAwareDelegator
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback) : ApplicationConfigAwareInterface
    {
        $config = $container->get('config');
        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();
        $requestedCallback = $callback();

        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if( $requestedCallback instanceof ApplicationFormAwareInterface
            && array_key_exists('app',$config)
            && array_key_exists('handler',$config['app'])
            && array_key_exists($name,$config['app']['handler'])
            && array_key_exists('route',$config['app']['handler'][$name])
            && array_key_exists($currentRouteName,$config['app']['handler'][$name]['route'])
            && array_key_exists($requestMethod,$config['app']['handler'][$name]['route'][$currentRouteName])
            && array_key_exists('forms',$config['app']['handler'][$name]['route'][$currentRouteName][$requestMethod])
        ) {
            $formsAppConfig = $config['app']['handler'][$name]['route'][$currentRouteName][$requestMethod]['forms'];
            if( ! empty($formsAppConfig)) {
                foreach($formsAppConfig as $formAppConfig) {
                    // form may be singleton or factory (from service NOT form_manager)
                    if( array_key_exists('object',$formAppConfig)) {
                        /* @var \Zend\Form\Form $form */
                        $form = new $formAppConfig['object']();
                    } elseif(array_key_exists('form_factory',$formAppConfig)) {
                        if($container->has($formAppConfig['form_factory'])) {
                            $form = $container->get($formAppConfig['form_factory']);
                        }
                    }

                    $formIndexName = (array_key_exists('name',$formAppConfig))
                        ? $formAppConfig['name']
                        : $form->getName();

                    // check if the save index is defined in the route config
                    if(array_key_exists('save',$formAppConfig)) {
                        foreach($formAppConfig['save'] as $fieldsetConfig) {
                            if(array_key_exists('service',$fieldsetConfig)) {
                                // Load each service from $container
                                foreach($fieldsetConfig['service'] as $serviceConfig) {
                                    if($container->has($serviceConfig['name'])) {
                                        $requestedCallback->setFieldsetService($container->get($serviceConfig['name']),$fieldsetConfig['fieldset_name']);
                                    }
                                }
                            }
                        }
                    }
                    $requestedCallback->setForm($form,$formIndexName);
                }
            }
        }

        return $requestedCallback;

    }
}