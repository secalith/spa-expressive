<?php

declare(strict_types=1);

namespace Block\Model;

class BlockModel
{
    public $uid;
    public $parent_uid;
    public $area_uid;
    public $template_uid;
    public $type;
    public $name;
    public $content;

    public $attributes;
    public $parameters;
    public $options;

    public $status;
    public $order;

    public $created;
    public $updated;

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid = ( ! empty($data['uid'])) ? $data['uid'] : null;
        $this->parent_uid = ( ! empty($data['parent_uid'])) ? $data['parent_uid'] : null;
        $this->area_uid = ( ! empty($data['area_uid'])) ? $data['area_uid'] : null;
        $this->template_uid = ( ! empty($data['template_uid'])) ? $data['template_uid'] : null;
        $this->type = ( ! empty($data['type'])) ? $data['type'] : null;
        $this->name = ( ! empty($data['name'])) ? $data['name'] : null;
        $this->content = ( ! empty($data['content'])) ? $data['content'] : null;

        $this->attributes = ( ! empty($data['attributes'])) ? $data['attributes'] : null;
        $this->parameters = ( ! empty($data['parameters'])) ? $data['parameters'] : null;
        $this->options = ( ! empty($data['options'])) ? $data['options'] : null;

        $this->status = ( ! empty($data['status'])) ? $data['status'] : null;
        $this->order = ( ! empty($data['order'])) ? $data['order'] : null;

        $this->created = ( ! empty($data['created'])) ? $data['created'] : null;
        $this->updated = ( ! empty($data['updated'])) ? $data['updated'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }
        if ($this->parent_uid !== null) {
            $data['parent_uid'] = $this->parent_uid;
        }
        if ($this->area_uid !== null) {
            $data['area_uid'] = $this->area_uid;
        }
        if ($this->template_uid !== null) {
            $data['template_uid'] = $this->template_uid;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->content !== null) {
            $data['content'] = $this->content;
        }

        if ($this->attributes !== null) {
            $data['attributes'] = $this->attributes;
        }
        if ($this->parameters !== null) {
            $data['parameters'] = $this->parameters;
        }
        if ($this->options !== null) {
            $data['options'] = $this->options;
        }

        if ($this->status !== null) {
            $data['status'] = $this->status;
        }
        if ($this->order !== null) {
            $data['order'] = $this->order;
        }

        if ($this->created !== null) {
            $data['created'] = $this->created;
        }
        if ($this->updated !== null) {
            $data['updated'] = $this->updated;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
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
     * @return BlockModel
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
     * @return BlockModel
     */
    public function setParentUid($parent_uid)
    {
        $this->parent_uid = $parent_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAreaUid()
    {
        return $this->area_uid;
    }

    /**
     * @param mixed $area_uid
     * @return BlockModel
     */
    public function setAreaUid($area_uid)
    {
        $this->area_uid = $area_uid;
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
     * @return BlockModel
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
     * @return BlockModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return BlockModel
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
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
     * @return BlockModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
