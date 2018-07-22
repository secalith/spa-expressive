<?php

namespace Common\Delegator;

use Zend\Form\Form as Form;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouteResourceAwareInterface
{
    public function addRouteResource($routeResource = null,$index=null);

    public function getRouteResource($name);
}
