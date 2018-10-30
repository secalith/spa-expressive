<?php

declare(strict_types=1);

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Expressive\Router\RouteResult;

class CurrentUrlHelper extends AbstractHelper
{

    private $routeResult;

    public function __invoke($name)
    {
        return $this->routeResult->getMatchedRouteName() === $name;

    }

    public function setRouteResult(RouteResult $result) {
        $this->routeResult = $result;
    }
}
