<?php

declare(strict_types=1);

namespace Common\Helper;

use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Helper\Exception\RuntimeException;
use Zend\Expressive\Router\RouterInterface;

class CurrentRouteNameHelper
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @var null|RouteResult
     */
    private $routeResult;

    public function __invoke()
    {
        return $this->getMatchedRouteName();
    }

    /**
     * @throw RuntimeException
     * @return string
     */
    public function getMatchedRouteName()
    {
        $result = $this->getRouteResult();
        if ($result === null) {
            throw new RuntimeException(
                'Attempting to use matched result when none was injected; aborting'
            );
        }

        return $result->getMatchedRouteName();
    }

    /**
     * @param RouteResult $result
     */
    public function setRouteResult(RouteResult $result)
    {
        $this->routeResult = $result;
    }

    /**
     * @return null|RouteResult
     */
    public function getRouteResult()
    {
        return $this->routeResult;
    }

    public function getMatchedParam($paramName)
    {
        $matchedParams = $this->routeResult->getMatchedParams();
        return $matchedParams[$paramName];
    }

    public function getMatchedParams()
    {
        $matchedParams = $this->routeResult->getMatchedParams();
        return $matchedParams;
    }
}
