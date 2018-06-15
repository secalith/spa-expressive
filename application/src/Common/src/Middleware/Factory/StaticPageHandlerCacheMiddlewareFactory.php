<?php

namespace Common\Middleware\Factory;

use Common\Middleware\StaticPageHandlerCacheMiddleware;
use Psr\Container\ContainerInterface;

class StaticPageHandlerCacheMiddlewareFactory
{

    private $module_name;

    public function __construct()
    {
        $this->module_name = 'static_pages';
    }

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $configCache = $config['cache']??[];
        $configApp = $config['app']??[];

        if( ! array_key_exists('enabled', $configCache) )
        {
            $configCache['enabled'] = false;
        }
        if( $configCache['enabled'] ) {

            if( ! isset($configCache['path'])) {
                throw new Exception('The cache path is not configured');
            }
            if( ! isset($configCache['lifetime'])) {
                throw new Exception('The cache lifetime is not configured');
            }

            $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();

            if( is_array($configApp)
                && ! empty($configApp)
                && array_key_exists($currentRouteName,$configApp['route'])
                && array_key_exists('cache_response',$configApp['route'][$currentRouteName])
            ) {
                $cacheResponseEnabled = $configApp['route'][$currentRouteName]['cache_response']['enabled'];
                if( $cacheResponseEnabled == true) {
                    $configCache['enabled'] = true;
                } else {
                    $configCache['enabled'] = false;
                }

            } else {
                $configCache['enabled'] = false;
            }
        }

        return new StaticPageHandlerCacheMiddleware($configCache);

    }
}