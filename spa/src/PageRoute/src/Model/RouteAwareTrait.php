<?php

declare(strict_types=1);

namespace PageRoute\Model;

trait RouteAwareTrait
{

    protected $route;
    protected $route_name;

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     * @return PageViewAwareTrait
     */
    public function setRoute($route) : RouteAwareInterface
    {
        $this->route = $route;
        return $this;
    }

    public function setRouteName($routeName) : RouteAwareInterface
    {
        $this->route_name = $routeName;
        return $this;
    }
    public function getRouteName() : string
    {
        return $this->route_name;
    }
}
