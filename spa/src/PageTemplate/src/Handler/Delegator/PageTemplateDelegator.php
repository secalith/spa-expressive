<?php

namespace PageTemplate\Handler\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Common\Handler\ApplicationConfigAwareInterface;
use Common\Handler\DataAwareInterface;
use Psr\Container\ContainerInterface;

class PageTemplateDelegator
{

    public function __invoke(ContainerInterface $container, string $name, callable $callback) : ApplicationConfigAwareInterface
    {
        $config = $container->get('config');
        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();
        $requestedCallback = $callback();

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

    public function createDelegatorWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName,
        $callback
    ) {
        $targetInstance = $callback();
//var_dump($targetInstance->getPage());
        if (null!==$targetInstance->getPage()) {
            // get page by route's UID
            $item = $serviceLocator->get("PageTemplate\\Table")->fetchBy(
                $targetInstance->getPage()->getTemplate(),
                'uid'
            );
            var_dump($item);
            $targetInstance->setTemplate($item);
        }

        return $targetInstance;
    }
}
