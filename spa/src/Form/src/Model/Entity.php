<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Content\Model;

use Common\Model\CommonModel as CommonModel;
use Zend\Json\Json as Json;

class Entity
{
    protected $attributes;
    protected $block;
    protected $content;
    protected $options;
    protected $order;
    protected $parameters;
    protected $template;
    protected $type;
    protected $uid;

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     * @return FormModel
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     * @return FormModel
     */
    public function setBlock($block)
    {
        $this->block = $block;
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
     * @return FormModel
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     * @return FormModel
     */
    public function setOptions($options)
    {
        $this->options = $options;
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
     * @return FormModel
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     * @return FormModel
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return FormModel
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return FormModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return FormModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
        if (null!==$this->getUid()) {
            $properties['uid'] = $this->getUid();
        }
        if (null!==$this->getBlock()) {
            $properties['block'] = $this->getBlock();
        }
        if (null!==$this->getOrder()) {
            $properties['order'] = $this->getOrder();
        }
        if (null!==$this->getTemplate()) {
            $properties['template'] = $this->getTemplate();
        }
        if (null!==$this->getType()) {
            $properties['type'] = $this->getType();
        }
        if (null!==$this->getContent()) {
            $properties['content'] = $this->getContent();
        }
        if (null!==$this->getAttributes()) {
            $properties['attributes'] = $this->getAttributes();
        }
        if (null!==$this->getParameters()) {
            $properties['parameters'] = $this->getParameters();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
