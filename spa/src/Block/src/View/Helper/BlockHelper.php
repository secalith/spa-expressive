<?php

declare(strict_types=1);

namespace Block\View\Helper;

use Zend\View\Helper\AbstractHelper;

class BlockHelper extends AbstractHelper
{
    /**
     * @param \Common\View\Model\ViewModel $item
     * @return string
     */
    public function __invoke($item)
    {

        $output = $this->getView()->plugin('openTag')($item);

        if( ! empty($item->getBlock())){
            /* @var $block \Block\Model\BlockModel*/
            foreach($item->getBlock() as $block) {
                switch ($block->getType()):
                    case 'carousel':
                        $output .= $this->getView()->plugin('displayBlockCarousel')($block);
                        break;
                    default:
                        $output .= $this->getView()->plugin('displayBlock')($block);
                        break;
                endswitch;
            }
        }

        if( ! empty($item->getContent())){
            /* @var $block \Block\Model\BlockModel*/
            foreach($item->getContent() as $content) {
                $output .= $this->getView()->plugin('displayContent')($content);
            }
        }

        $output .= $this->getView()->plugin('closeTag')($item);

        return $output;
    }
}
