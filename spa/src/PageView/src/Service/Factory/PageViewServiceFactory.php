<?php

declare(strict_types=1);

namespace PageView\Service\Factory;

use PageView\Service\PageViewService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PageViewServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tablePage = $container->get("Page\\TableService");
        $tableTemplate = $container->get("PageTemplate\\TableService");
        $tableArea = $container->get("Area\\TableService");
        $serviceBlock = $container->get(\Block\Service\BlockService::class);
        $serviceContent = $container->get(\Content\Service\ContentService::class);

        return new PageViewService($tablePage,$tableTemplate,$tableArea,$serviceBlock,$serviceContent);
    }
}
