<?php
namespace Common\View\Model;

use Area\Model\AreaModel as AreaModel;
use Block\Model\BlockModel as BlockModel;
use Content\Model\ContentModel as ContentModel;

class ViewModel
{
    /**
     * @var AreaModel|BlockModel|ContentModel|null
     */
    protected $data;
    /**
     * @var AreaModel|null
     */
    protected $area;

    /**
     * @var BlockModel|null
     */
    protected $block;

    protected $form;

    /**
     * @var string
     */
    protected $type;
    /**
     * @var ContentModel|null
     */
    protected $content;

    public function __construct($item = null)
    {
        if(! empty($item)) {
            $this->data = $item;
            if(is_object($item)) {
                switch(get_class($item)){
                    case 'Area\Model\AreaModel':
                        $this->setType('area');
                        break;
                    case 'Block\Model\BlockModel':
                        $this->setType('block');
                        break;
                    case 'Content\Model\ContentModel':
                        $this->setType('content');
                        break;
                    default:
                }
            }
        }
    }

    /**
     * @return AreaModel|BlockModel|ContentModel|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param AreaModel|BlockModel|ContentModel|null $data
     * @return ViewModel
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return AreaModel|null
     */
    public function getArea($area=null)
    {
        if( null !== $area && is_string($area) && array_key_exists($area,$this->area)) {
            return array_shift($this->area[$area]);
        } elseif(is_object($area) && method_exists($area,'getUid')) {
            // @todo: instance of CommonEntityInterface
            if( array_key_exists($area->getMachineName(),$this->area)) {
                if( array_key_exists($area->getUid(),$this->area[$area->getMachineName()])) {
                    return $this->area[$area->getMachineName()][$area->getUid()];
                }
            }
        }

        return $this->area;
    }

    /**
     * @param mixed $area
     * @return ViewModel
     */
    public function setArea(AreaModel $area)
    {
        $this->area[$area->getMachineName()][$area->getUid()] = new ViewModel($area);
        return $this;
    }

    /**
     * @return BlockModel|null
     */
    public function getBlock($block=null)
    {
        if( null !== $block && is_string($block) && array_key_exists($block,$this->block)) {
            return $this->block[$block];
        } elseif(is_object($block) && method_exists($block,'getUid')) {
            // @todo: instance of CommonEntityInterface
            if( array_key_exists($block->getUid(),$this->block)) {
                return $this->block[$block->getUid()];
            }
        }

        return $this->block;
    }

    /**
     * @param BlockModel $block
     * @return ViewModel
     */
    public function setBlock(BlockModel $block)
    {
        $this->block[$block->getUid()] = new ViewModel($block);
        return $this;
    }

    /**
     * @return ContentModel|null
     */
    public function getContent($content=null)
    {
        if( null !== $content && is_string($content) && array_key_exists($content,$this->content)) {
            return $this->content[$content];
        } elseif(is_object($content) && method_exists($content,'getUid')) {
            // @todo: instance of CommonEntityInterface
            if( array_key_exists($content->getUid(),$this->content)) {
                return $this->content[$content->getUid()];
            }
        }
        return $this->content;
    }

    /**
     * @param ContentModel $content
     * @return ViewModel
     */
    public function setContent(ContentModel $content)
    {
        $this->content[$content->getUid()] = new ViewModel($content);
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ViewModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}