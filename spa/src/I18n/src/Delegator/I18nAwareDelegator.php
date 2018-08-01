<?php

namespace i18n\Delegator;

use Common\Handler\ApplicationConfigAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class I18nAwareDelegator
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback) : ApplicationConfigAwareInterface
    {
        $config = $container->get('config');
        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();
        $requestedCallback = $callback();

        $translator = $container->get(\Zend\I18n\Translator\TranslatorInterface::class);
        $translator->setLocale('fr_FR');
//        $translator->setLocale('en_EN');
//        echo  $translator->getLocale();die;
//die();

        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if( $requestedCallback instanceof ApplicationConfigAwareInterface
            && array_key_exists('app',$config)
            && array_key_exists('handler',$config['app'])
            && array_key_exists($name,$config['app']['handler'])
            && array_key_exists('route',$config['app']['handler'][$name])
            && array_key_exists($currentRouteName,$config['app']['handler'][$name]['route'])
            && array_key_exists($requestMethod,$config['app']['handler'][$name]['route'][$currentRouteName])
        ) {
            if($requestedCallback instanceof DataAwareInterface) {
                $requestedCallback->addData($config['app']['handler'][$name]['route'][$currentRouteName][$requestMethod],'handler_config');
            } else {
                $requestedCallback->setHandlerConfig($config['app']['handler'][$name]['route'][$currentRouteName][$requestMethod]);
            }
        }

        return $requestedCallback;

    }
}