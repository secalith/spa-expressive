<?php

declare(strict_types=1);

namespace Area\Service\Factory;

use Area\Service\AreaService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class AreaServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tableArea = $container->get("Area\\TableService");

        return new AreaService($tableArea);
    }
}
