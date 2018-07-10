<?php

declare(strict_types=1);

namespace Page\Service\Factory;

use Page\Service\PageService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PageServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $tablePage = $container->get("Page\\TableService");
        $tableTemplate = $container->get("PageTemplate\\TableService");
        $tableArea = $container->get("Area\\TableService");
        $tableBlock = $container->get("Block\\TableService");
        $tableContent = $container->get("Content\\TableService");
        $hostname = php_uname('n');
        /* @var \Instance\Model\InstanceModel $instance */
        $instance = $container->get("Instance\\TableService")->fetchBy(['hostname'=>$hostname]);

        return new PageService($tablePage,$instance);
    }
}
