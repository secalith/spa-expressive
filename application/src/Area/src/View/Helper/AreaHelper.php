<?php
namespace Area\View\Helper;

use Common\View\Model\ViewModel;
use Zend\View\Helper\AbstractHelper;

class AreaHelper extends AbstractHelper
{
    public function __invoke($item)
    {
        if(null===$item || ! is_object($item)) {
            return;
        }

        $output = $this->getView()->plugin('openTag')($item);

        if( ! empty($item->getBlock())){
            /* @var $block \Block\Model\BlockModel*/
            foreach($item->getBlock() as $block) {
                $output .= $this->getView()->plugin('displayBlock')($block);
            }
        }

        $output .= $this->getView()->plugin('closeTag')($item);

        return $output;
    }
}
