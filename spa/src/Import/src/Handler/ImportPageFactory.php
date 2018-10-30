<?php

declare(strict_types=1);

namespace Import\Handler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ImportPageFactory
{
    public function __invoke(ContainerInterface $container) : ImportPage
    {
        return new ImportPage($container->get(TemplateRendererInterface::class));
    }
}
