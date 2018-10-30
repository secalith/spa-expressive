<?php

declare(strict_types=1);

namespace Common\Helper\Factory;

use Common\Helper\CurrentHandlerNameHelper;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Helper\Exception\MissingRouterException;

class CurrentHandlerNameHelperFactory
{

    /**
     * @param ContainerInterface $container
     * @return CurrentHandlerNameHelper
     */
    public function __invoke(ContainerInterface $container)
    {

        return new CurrentHandlerNameHelper();
    }
}
