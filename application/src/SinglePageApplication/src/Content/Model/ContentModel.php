<?php
namespace SinglePageApplication\Content\Model;

use SinglePageApplication\Common\Model\CommonModel as CommonModel;
use Zend\Json\Json as Json;

class ContentModel extends CommonModel
{
    public $block;
    public $order;
    public $content;

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     * @return ContentModel
     */
    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return ContentModel
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return ContentModel
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->block = (!empty($data['block'])) ? $data['block'] : null;
        $this->order = (!empty($data['order'])) ? $data['order'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->content = (!empty($data['content'])) ? $data['content'] : null;
        $this->attributes = (!empty($data['attributes'])) ? $data['attributes'] : null;
        $this->setAttributes($this->getAttributes());
        $this->parameters = (!empty($data['parameters'])) ? $data['parameters'] : null;
        $this->setParameters($this->getParameters());
    }

    public function toArray()
    {
        $properties = null;
        if(null!==$this->getUid()) {
            $properties['uid'] = $this->getUid();
        }
        if(null!==$this->getBlock()) {
            $properties['block'] = $this->getBlock();
        }
        if(null!==$this->getOrder()) {
            $properties['order'] = $this->getOrder();
        }
        if(null!==$this->getTemplate()) {
            $properties['template'] = $this->getTemplate();
        }
        if(null!==$this->getType()) {
            $properties['type'] = $this->getType();
        }
        if(null!==$this->getContent()) {
            $properties['content'] = $this->getContent();
        }
        if(null!==$this->getAttributes()) {
            $properties['attributes'] = $this->getAttributes();
        }
        if(null!==$this->getParameters()) {
            $properties['parameters'] = $this->getParameters();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}