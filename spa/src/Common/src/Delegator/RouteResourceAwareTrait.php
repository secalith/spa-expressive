<?php

namespace Common\Delegator;

trait RouteResourceAwareTrait
{
    /**
     * @var array|null
     */
    protected $routeResource;


    public function addRouteResource($routeResource = null,$index=null)
    {
        $this->routeResource[$index] = $routeResource;
        return $this;
    }


    public function getRouteResource($name)
    {
        if (array_key_exists($name, $this->routeResource)) {
            return $this->routeResource[$name];
        }
        return null;
    }
}
