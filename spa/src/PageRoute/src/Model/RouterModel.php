<?php

declare(strict_types=1);

namespace PageRoute\Model;

class RouterModel
{
    public $uid;
    public $parent_uid;
    public $application_uid;
    public $route_uid;
    public $route_url;
    public $scenario;
    public $controller;
    public $method;

    public $attributes;

    public $status;

    public $created;
    public $updated;


    /**
     * RouterModel constructor.
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
        $this->application_uid = ( array_key_exists('application_uid',$data)) ? $data['application_uid'] : null;
        $this->route_uid = ( array_key_exists('route_uid',$data)) ? $data['route_uid'] : null;
        $this->route_url = ( array_key_exists('route_url',$data)) ? $data['route_url'] : null;
        $this->scenario = ( array_key_exists('scenario',$data)) ? $data['scenario'] : null;
        $this->controller = ( array_key_exists('controller',$data)) ? $data['controller'] : null;
        $this->method = ( array_key_exists('method',$data)) ? $data['method'] : null;

        $this->attributes = ( array_key_exists('attributes',$data)) ? $data['attributes'] : null;

        $this->status = ( array_key_exists('status',$data)) ? $data['status'] : null;

        $this->created = ( array_key_exists('created',$data)) ? $data['created'] : null;
        $this->updated = ( array_key_exists('updated',$data)) ? $data['updated'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['parent_uid'] = $this->parent_uid;
        $data['application_uid'] = $this->application_uid;
        $data['route_uid'] = $this->route_uid;
        $data['route_url'] = $this->route_url;
        $data['scenario'] = $this->scenario;
        $data['controller'] = $this->controller;
        $data['method'] = $this->method;

        $data['attributes'] = $this->attributes;

        $data['status'] = $this->status;

        $data['created'] = $this->created;
        $data['updated'] = $this->updated;


        return $data;
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
     * @return RouterModel
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
     * @return RouterModel
     */
    public function setParentUid($parent_uid)
    {
        $this->parent_uid = $parent_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplicationUid()
    {
        return $this->application_uid;
    }

    /**
     * @param mixed $application_uid
     * @return RouterModel
     */
    public function setApplicationUid($application_uid)
    {
        $this->application_uid = $application_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteUid()
    {
        return $this->route_uid;
    }

    /**
     * @param mixed $route_uid
     * @return RouterModel
     */
    public function setRouteUid($route_uid)
    {
        $this->route_uid = $route_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteUrl()
    {
        return $this->route_url;
    }

    /**
     * @param mixed $route_url
     * @return RouterModel
     */
    public function setRouteUrl($route_url)
    {
        $this->route_url = $route_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScenario()
    {
        return $this->scenario;
    }

    /**
     * @param mixed $scenario
     * @return RouterModel
     */
    public function setScenario($scenario)
    {
        $this->scenario = $scenario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     * @return RouterModel
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return RouterModel
     */
    public function setMethod($method)
    {
        $this->method = $method;
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
     * @return RouterModel
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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
     * @return RouterModel
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
     * @return RouterModel
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
     * @return RouterModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
}
