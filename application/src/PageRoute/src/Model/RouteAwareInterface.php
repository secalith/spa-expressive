<?php

declare(strict_types=1);

namespace PageRoute\Model;

interface RouteAwareInterface
{

    public function setRouteName($routeName) : RouteAwareInterface;
    public function getRouteName() : string;
    public function setRoute($route) : RouteAwareInterface;
    public function getRoute();
}
