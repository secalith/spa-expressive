<?php

declare(strict_types=1);

namespace PageRoute\Model;

class RouterModel
{
    public $uid;
    public $route_uid;
    public $parent_uid;
    public $route;
    public $pagecache;
    public $scenario;
    public $action;
    public $controller;
    public $submodule;
    public $module;
    public $name;
    public $child_routes;
    public $constraints;
    public $methods;

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

    public function exchangeArray($data)
    {
        $this->uid = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->route_uid = (!empty($data['route_uid'])) ? $data['route_uid'] : null;
        $this->parent_uid = (!empty($data['parent_uid'])) ? $data['parent_uid'] : null;
        $this->route = (!empty($data['route'])) ? $data['route'] : null;
        $this->pagecache = (!empty($data['pagecache'])) ? $data['pagecache'] : null;
        $this->scenario = (!empty($data['scenario'])) ? $data['scenario'] : null;
        $this->action = (!empty($data['action'])) ? $data['action'] : null;
        $this->controller = (!empty($data['controller'])) ? $data['controller'] : null;
        $this->submodule = (!empty($data['submodule'])) ? $data['submodule'] : null;
        $this->module = (!empty($data['module'])) ? $data['module'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->child_routes = (!empty($data['child_routes'])) ? $data['child_routes'] : null;
        $this->constraints = (!empty(json_decode($data['constraints']))) ? json_decode($data['constraints']) : null;
        $this->methods = (!empty(json_decode($data['methods']))) ? json_decode($data['methods']) : null;
    }
}
