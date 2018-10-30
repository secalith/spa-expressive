<?php

namespace Common\Middleware\Factory;

use Common\Middleware\HandlerCacheMiddleware;
use Psr\Container\ContainerInterface;

class HandlerCacheMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = $config['cache']??[];
        if( ! array_key_exists('enabled', $config))
        {
            $config['enabled'] = false;
        }
        if($config['enabled']) {
            if( ! isset($config['path'])) {
                throw new Exception('The cache path is not configured');
            }
            if( ! isset($config['lifetime'])) {
                throw new Exception('The cache lifetime is not configured');
            }



        }
        return new HandlerCacheMiddleware($config);
    }
}