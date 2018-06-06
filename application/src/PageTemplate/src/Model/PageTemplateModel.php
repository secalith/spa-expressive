<?php

declare(strict_types=1);

namespace PageTemplate\Model;

class PageTemplateModel
{
    public $uid;
    public $name;
    public $type;
    public $location;
    public $label;

    public $status;

    public $created;
    public $updated;

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
        $this->location = (!empty($data['location'])) ? $data['location'] : null;
        $this->label = (!empty($data['label'])) ? $data['label'] : null;

        $this->status = (!empty($data['status'])) ? $data['status'] : null;

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
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type;
        }
        if ($this->location !== null) {
            $data['location'] = $this->location;
        }

        if ($this->label !== null) {
            $data['label'] = $this->label;
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
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
     * @return TemplateModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
     * @return TemplateModel
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return TemplateModel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return TemplateModel
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return TemplateModel
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
     * @return TemplateModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return TemplateModel
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
     * @return TemplateModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
