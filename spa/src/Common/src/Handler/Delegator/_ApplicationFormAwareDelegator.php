<?php

declare(strict_types=1);

namespace Common\Handler\Delegator;

use Common\Handler\ApplicationConfigAwareInterface;
use Common\Handler\ApplicationFormAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class ApplicationFormAwareDelegator
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
                    // check if the action is defined
                    if($formAppConfig['action']) {
                        if(array_key_exists('route',$formAppConfig['action'])) {
                            $urlHelper = $container->get(UrlHelper::class);
                            $form->setAttribute('action',$urlHelper->generate($formAppConfig['action']['route']));
                        } elseif(array_key_exists('url',$formAppConfig['action'])) {
                            $form->setAttribute('action',$formAppConfig['action']['url']);
                        }
                    }
                    $requestedCallback->setForm($form,$formIndexName);
                }
            }
        }

        return $requestedCallback;

    }
}