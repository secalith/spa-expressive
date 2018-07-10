<?php

declare(strict_types=1);

namespace Content\Model;

class ContentModel
{
    public $uid;
    public $parent_uid;
    public $block_uid;
    public $template_uid;
    public $type;
    public $content;

    public $attributes;
    public $parameters;
    public $options;

    public $status;
    public $order;

    public $created;
    public $updated;

    /**
     * ContentModel constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid = ( array_key_exists('uid',$data)) ? $data['uid'] : null;
        $this->parent_uid = ( array_key_exists('parent_uid',$data)) ? $data['parent_uid'] : null;
        $this->block_uid = ( array_key_exists('block_uid',$data)) ? $data['block_uid'] : null;
        $this->template_uid = ( array_key_exists('template_uid',$data)) ? $data['template_uid'] : null;
        $this->type = ( array_key_exists('type',$data)) ? $data['type'] : null;
        $this->content = ( array_key_exists('content',$data)) ? $data['content'] : null;

        $this->attributes = ( array_key_exists('attributes',$data)) ? $data['attributes'] : null;
        $this->parameters = ( array_key_exists('parameters',$data)) ? $data['parameters'] : null;
        $this->options = ( array_key_exists('options',$data)) ? $data['options'] : null;

        $this->status = ( array_key_exists('status',$data)) ? $data['status'] : null;
        $this->order = ( array_key_exists('order',$data)) ? $data['order'] : null;

        $this->created = ( array_key_exists('created',$data)) ? $data['created'] : null;
        $this->updated = ( array_key_exists('updated',$data)) ? $data['updated'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['parent_uid'] = $this->parent_uid;
        $data['block_uid'] = $this->block_uid;
        $data['template_uid'] = $this->template_uid;
        $data['type'] = $this->type;
        $data['content'] = $this->content;

        $data['attributes'] = $this->attributes;
        $data['parameters'] = $this->parameters;
        $data['options'] = $this->options;

        $data['status'] = $this->status;
        $data['order'] = $this->order;

        $data['created'] = $this->created;
        $data['updated'] = $this->updated;

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
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
     * @return ContentModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentUid()
    {
        return $this->parent_uid;
    }

    /**
     * @param mixed $parent_uid
     * @return ContentModel
     */
    public function setParentUid($parent_uid)
    {
        $this->parent_uid = $parent_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlockUid()
    {
        return $this->block_uid;
    }

    /**
     * @param mixed $block_uid
     * @return ContentModel
     */
    public function setBlockUid($block_uid)
    {
        $this->block_uid = $block_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateUid()
    {
        return $this->template_uid;
    }

    /**
     * @param mixed $template_uid
     * @return ContentModel
     */
    public function setTemplateUid($template_uid)
    {
        $this->template_uid = $template_uid;
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
     * @return ContentModel
     */
    public function setType($type)
    {
        $this->type = $type;
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

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     * @return ContentModel
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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
     * @return ContentModel
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
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
     * @return ContentModel
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ContentModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return ContentModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return ContentModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
