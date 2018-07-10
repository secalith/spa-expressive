<?php

namespace Common\View\Helper\Factory;

use Common\View\Helper\CurrentUrlHelper;
use Common\View\Helper\DisplayLinkGroupHelper;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class DisplayLinkGroupHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $currentUrlHelper = $container->get(CurrentUrlHelper::class);
        $urlHelper = $container->get(UrlHelper::class);

        return new DisplayLinkGroupHelper($urlHelper,$currentUrlHelper);
    }
}