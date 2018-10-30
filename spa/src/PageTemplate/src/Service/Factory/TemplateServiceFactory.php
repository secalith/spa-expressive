<?php

declare(strict_types=1);

namespace PageTemplate\Service\Factory;

use PageTemplate\Service\TemplateService;
use Psr\Container\ContainerInterface;

class TemplateServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tableTemplate = $container->get("PageTemplate\\TableService");

        return new TemplateService($tableTemplate);
    }

}
