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

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->parent_uid = (!empty($data['parent_uid'])) ? $data['parent_uid'] : null;
        $this->block_uid = (!empty($data['block_uid'])) ? $data['block_uid'] : null;
        $this->template_uid = (!empty($data['template_uid'])) ? $data['template_uid'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->content = (!empty($data['content'])) ? $data['content'] : null;

        $this->attributes = (!empty($data['attributes'])) ? $data['attributes'] : null;
        $this->parameters = (!empty($data['parameters'])) ? $data['parameters'] : null;
        $this->options = (!empty($data['options'])) ? $data['options'] : null;

        $this->status = (!empty($data['status'])) ? $data['status'] : null;
        $this->order = (!empty($data['order'])) ? $data['order'] : null;

        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
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
        if ($this->block_uid !== null) {
            $data['block_uid'] = $this->block_uid;
        }
        if ($this->template_uid !== null) {
            $data['template_uid'] = $this->template_uid;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type;
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
        return get_object_vars($this);
    }
}
