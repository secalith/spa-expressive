<?php

namespace I18n\View\Helper\Factory;

use I18n\View\Helper\I18nCurrentViewHelper;
use Psr\Container\ContainerInterface;

class I18nCurrentFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /* @var \I18n\Service\I18n $i18nService */
        $i18nService = $container->get(\I18n\Service\I18n::class);

        return new I18nCurrentViewHelper($i18nService->getCurrentLanguage());
    }
}