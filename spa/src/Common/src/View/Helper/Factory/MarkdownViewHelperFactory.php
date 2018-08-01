<?php

namespace Common\View\Helper\Factory;

use Common\View\Helper\MarkdownViewHelper;
use Common\View\Helper\CurrentUrlHelper;
use Psr\Container\ContainerInterface;

class MarkdownViewHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $markdownService = $container->get(\Common\Service\MarkdownService::class);
        return new MarkdownViewHelper($markdownService);
    }
}