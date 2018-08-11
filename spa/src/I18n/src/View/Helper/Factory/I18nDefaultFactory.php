<?php

namespace I18n\View\Helper\Factory;

use I18n\View\Helper\I18nDefaultViewHelper;
use Psr\Container\ContainerInterface;

class I18nDefaultFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /* @var \I18n\Service\I18n $i18nService */
        $i18nService = $container->get(\I18n\Service\I18n::class);

        return new I18nDefaultViewHelper($i18nService->getDefaultLanguage());
    }
}