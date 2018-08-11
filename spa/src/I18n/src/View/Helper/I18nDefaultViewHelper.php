<?php

declare(strict_types=1);

namespace I18n\View\Helper;

use Zend\View\Helper\AbstractHelper;

class I18nDefaultViewHelper extends AbstractHelper
{

    private $defaultLanguage;

    public function __construct($defaultLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
    }

    public function __invoke()
    {
        return $this->defaultLanguage;
    }
}
