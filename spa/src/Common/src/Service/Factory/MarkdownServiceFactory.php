<?php

namespace Common\Service\Factory;

use Common\Service\MarkdownService;
use Common\Service\RouteConfigService;
use Michelf\Markdown;
use Psr\Container\ContainerInterface;

class MarkdownServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $markdownService = new Markdown();
        return new MarkdownService($markdownService);
    }
}