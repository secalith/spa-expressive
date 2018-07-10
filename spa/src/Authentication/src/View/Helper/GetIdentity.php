<?php
namespace Authentication\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetIdentity extends AbstractHelper
{
    public $authService;

    /**
     * @param \Common\View\Model\ViewModel $item
     * @return string
     */
    public function __invoke()
    {
        return $this->authService->getIdentity();

    }
}
