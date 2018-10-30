<?php

declare(strict_types=1);

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

class IsFormSet extends AbstractHelper
{
    protected $cartService;

    public function __invoke($forms, $itemId, $index)
    {
        $itemIdentifier = sprintf("id_%s",$itemId);
        if( array_key_exists($itemIdentifier, $forms)
            && array_key_exists('form',$forms[$itemIdentifier])
            && array_key_exists($index,$forms[$itemIdentifier]['form'])
        ) {
            return true;
        }
        return false;
    }
}
