<?php

namespace Common\Middleware;

use Common\Helper\CurrentRouteNameHelper;
use Common\View\Helper\CurrentUrlHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


/**
 * Middleware to implement the PRG Pattern in a Zend Expressive app
 */
class CurrentRouteNameMiddleware  implements MiddlewareInterface
{

    private $currentRouteNameHelper;

    public function __construct(CurrentRouteNameHelper $currentUrlHelper) {
        $this->currentRouteNameHelper = $currentUrlHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {
        $result = $request->getAttribute(\Zend\Expressive\Router\RouteResult::class);
        $this->currentRouteNameHelper->setRouteResult($result);

        return $handler->handle($request);
    }

}
