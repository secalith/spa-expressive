<?php

namespace Common\Service\Factory;

use Common\Service\PaginatorQueryService;
use Psr\Container\ContainerInterface;

class PaginatorQueryServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new PaginatorQueryService();
    }
}