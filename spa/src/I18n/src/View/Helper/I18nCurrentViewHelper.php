<?php

declare(strict_types=1);

namespace I18n\View\Helper;

use Zend\View\Helper\AbstractHelper;

class I18nCurrentViewHelper extends AbstractHelper
{

    private $currentLanguage;

    public function __construct($currentLanguage)
    {
        $this->currentLanguage = $currentLanguage;
    }

    /**
     * @param $linkGroup
     * @return string
     */
    public function __invoke()
    {
        return $this->currentLanguage;
    }
}
