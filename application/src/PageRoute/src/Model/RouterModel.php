<?php

declare(strict_types=1);

namespace PageRoute\Model;

class RouterModel
{
    public $uid;
    public $parent_uid;
    public $route_uid;
    public $route_url;
    public $scenario;
    public $controller;

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
        $this->route_uid = ( array_key_exists('route_uid',$data)) ? $data['route_uid'] : null;
        $this->route_url = ( array_key_exists('route_url',$data)) ? $data['route_url'] : null;
        $this->scenario = ( array_key_exists('scenario',$data)) ? $data['scenario'] : null;
        $this->controller = ( array_key_exists('controller',$data)) ? $data['controller'] : null;

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
        $data['route_uid'] = $this->route_uid;
        $data['route_url'] = $this->route_url;
        $data['scenario'] = $this->scenario;
        $data['controller'] = $this->controller;

        $data['attributes'] = $this->attributes;

        $data['status'] = $this->status;

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

    public function getUid()
    {
        return $this->uid;
    }

    public function getRouteUid()
    {
        return $this->route_uid;
    }

    public function getParentUid()
    {
        return $this->parent_uid;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getPageCache()
    {
        return $this->pagecache;
    }

    public function getScenarioName()
    {
        return $this->scenario;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getSubmodule()
    {
        return $this->submodule;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setChildRoutes($routes)
    {
        $this->child_routes = $routes;
        return $this;
    }
    public function getChildRoutes()
    {
        return $this->child_routes;
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
     * @return RouteRoutesModel
     */
    public function setScenario($scenario)
    {
        $this->scenario = $scenario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param mixed $constrains
     * @return RouteRoutesModel
     */
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param mixed $methods
     * @return RouteRoutesModel
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
        return $this;
    }


}
