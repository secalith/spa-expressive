<?php

declare(strict_types=1);

namespace Auth\Handler;

use Auth\Handler\AuthHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use	Zend\Diactoros\Response\RedirectResponse;

class FooHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new RedirectResponse('/');
    }
}
