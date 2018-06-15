<?php

declare(strict_types=1);

namespace Block\Service\Factory;

use Block\Service\BlockService;
use Psr\Container\ContainerInterface;

class BlockServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tableArea = $container->get("Area\\TableService");
        $tableBlock = $container->get("Block\\TableService");
        $tableContent = $container->get("Content\\TableService");

        return new BlockService($tableArea,$tableBlock,$tableContent);
    }

}
