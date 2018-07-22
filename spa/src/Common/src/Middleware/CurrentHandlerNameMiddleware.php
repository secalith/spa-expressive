<?php

namespace Common\Middleware;

use Common\Helper\CurrentHandlerNameHelper;
use Common\View\Helper\CurrentUrlHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


/**
 * Middleware to implement the PRG Pattern in a Zend Expressive app
 */
class CurrentHandlerNameMiddleware  implements MiddlewareInterface
{

    private $currentHandlerNameHelper;

    public function __construct(CurrentHandlerNameHelper $currentHandlerHelper) {
        $this->currentHandlerNameHelper = $currentHandlerHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {
        var_dump($handler);die();
        $this->currentHandlerNameHelper->setHandlerName($handler);

        return $handler->handle($request);
    }

}
