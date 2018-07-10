<?php
namespace SinglePageApplication\Route\Model;

class RouteModel
{
    public $uid;
    public $route_name;

    public function getUid()
    {
        return $this->uid;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->route_name = (!empty($data['route_name'])) ? $data['route_name'] : null;
    }
}