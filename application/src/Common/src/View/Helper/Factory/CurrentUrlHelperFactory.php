<?php

namespace Common\View\Helper\Factory;

use Common\View\Helper\CurrentUrlHelper;
use Psr\Container\ContainerInterface;

class CurrentUrlHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return $container->get(CurrentUrlHelper::class);
    }
}