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
     * AreaModel constructor.
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
        $this->template_uid = ( array_key_exists('template_uid',$data)) ? $data['template_uid'] : null;
        $this->machine_name = ( array_key_exists('machine_name',$data)) ? $data['machine_name'] : null;
        $this->scope = ( array_key_exists('scope',$data)) ? $data['scope'] : null;

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
        $data['template_uid'] = $this->template_uid;
        $data['machine_name'] = $this->machine_name;
        $data['scope'] = $this->scope;

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
