<?php

declare(strict_types=1);

namespace Content\Service\Factory;

use Content\Service\ContentService;
use Psr\Container\ContainerInterface;

class ContentServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tableArea = $container->get("Area\\TableService");
        $tableBlock = $container->get("Block\\TableService");
        $tableContent = $container->get("Content\\TableService");

        return new ContentService($tableArea,$tableBlock,$tableContent);
    }

}
