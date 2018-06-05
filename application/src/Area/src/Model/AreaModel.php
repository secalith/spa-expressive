<?php

declare(strict_types=1);

namespace Area\Model;

class AreaModel
{
    public $uid;
    public $template_uid;
    public $machine_name;
    public $scope;

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
        $this->template_uid = ( ! empty($data['template_uid'])) ? $data['template_uid'] : null;
        $this->machine_name = ( ! empty($data['machine_name'])) ? $data['machine_name'] : null;
        $this->scope = ( ! empty($data['scope'])) ? $data['scope'] : null;

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
        if ($this->template_uid !== null) {
            $data['template_uid'] = $this->template_uid;
        }
        if ($this->machine_name !== null) {
            $data['machine_name'] = $this->machine_name;
        }
        if ($this->scope !== null) {
            $data['scope'] = $this->scope;
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
     * @return AreaModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
     * @return AreaModel
     */
    public function setTemplateUid($template_uid)
    {
        $this->template_uid = $template_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMachineName()
    {
        return $this->machine_name;
    }

    /**
     * @param mixed $machine_name
     * @return AreaModel
     */
    public function setMachineName($machine_name)
    {
        $this->machine_name = $machine_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param mixed $scope
     * @return AreaModel
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
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
     * @return AreaModel
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
     * @return AreaModel
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
     * @return AreaModel
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
     * @return AreaModel
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
     * @return AreaModel
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
     * @return AreaModel
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
     * @return AreaModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }



}
