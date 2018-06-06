<?php

declare(strict_types=1);

namespace PageRoute\Model;

class RouteModel
{
    public $uid;
    public $route_name;

    public $status;

    public $created;
    public $updated;

    public function exchangeArray($data = [])
    {
        $this->uid = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->route_name = (!empty($data['route_name'])) ? $data['route_name'] : null;

        $this->status = ( ! empty($data['status'])) ? $data['status'] : null;

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
        if ($this->route_name !== null) {
            $data['route_name'] = $this->route_name;
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
     * @return RouteModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->route_name;
    }

    /**
     * @param mixed $route_name
     * @return RouteModel
     */
    public function setRouteName($route_name)
    {
        $this->route_name = $route_name;
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
     * @return RouteModel
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
     * @return RouteModel
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
     * @return RouteModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
