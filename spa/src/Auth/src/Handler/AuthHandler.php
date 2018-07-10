<?php

declare(strict_types=1);

namespace	Auth\Handler;

use	Zend\Authentication\AuthenticationService;
use	Zend\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\ZendView\ZendViewRenderer;

class AuthHandler implements MiddlewareInterface
{
    private $containerName;

    private $router;

    private $template;

    private	$auth;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        AuthenticationService $auth
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->auth = $auth;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {
        if	(!	$this->auth->hasIdentity())	{
            return new RedirectResponse('/login');
        }
        $identity = $this->auth->getIdentity();

        return	$handler->handle($request->withAttribute(self::class,	$identity));
    }

}