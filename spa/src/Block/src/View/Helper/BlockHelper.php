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


        switch($item->getData()->getType()) {
            case 'block-event':

                $output .= $this->getView()->plugin('displayEventsListBlock')($item);

                break;
            default:
                if( ! empty($item->getBlock())) {
                    foreach($item->getBlock() as $block) {
                        $output .= $this->getView()->plugin('displayBlock')($block);
                    }
                }
        }

        if( ! empty($item->getContent())){
            /* @var $block \Block\Model\BlockModel*/
            foreach($item->getContent() as $content) {var_dump($content);
                $output .= $this->getView()->plugin('displayContent')($content);
            }
        }

        $output .= $this->getView()->plugin('closeTag')($item);

        return $output;
    }
}
