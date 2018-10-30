<?php

declare(strict_types=1);

namespace Common\Helper;

use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Helper\Exception\RuntimeException;
use Zend\Expressive\Router\RouterInterface;

class CurrentHandlerNameHelper
{

    /**
     * @var RouterInterface
     */
    private $handlerName;

    /**
     * @param RouterInterface $router
     */
    public function __construct()
    {

    }

    public function __invoke()
    {
        return $this->getMatchedHandlerName();
    }

    public function setMatchedHandlerName($name)
    {
        $this->handlerName = $name;

        return $this;
    }

    /**
     * @throw RuntimeException
     * @return string
     */
    public function getMatchedHandlerName()
    {
        return $this->handlerName;
        $result = $this->getRouteResult();
        if ($result === null) {
            throw new RuntimeException(
                'Attempting to use matched result when none was injected; aborting'
            );
        }

        return $result->getMatchedRouteName();
    }
}
