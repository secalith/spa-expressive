<?php

declare(strict_types=1);

namespace Auth\Handler;

use	Auth\Adapter\AuthAdapter;
use PageView\Handler\PageViewAwareInterface;
use PageView\Handler\PageViewAwareTrait;
use Psr\Http\Server\RequestHandlerInterface;
use	Psr\Http\Message\ServerRequestInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Diactoros\Response\HtmlResponse;
use	Zend\Diactoros\Response\RedirectResponse;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Psr\Http\Message\ResponseInterface;

class LoginHandler implements  PageViewAwareInterface
{
    use PageViewAwareTrait;

    private $containerName;

    private $router;

    private	$auth;
    private	$authAdapter;
    private	$template;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        AuthenticationService $auth,
        AuthAdapter $authAdapter
    ) {
        $this->template = $template;
        $this->auth = $auth;
        $this->authAdapter = $authAdapter;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if($request->getMethod() === 'POST') {
            return $this->authenticate($request);
        }
        return	new	HtmlResponse($this->template->render('auth::login'));
    }

    public function authenticate(ServerRequestInterface	$request)
    {
        $params = $request->getParsedBody();
        if (empty($params['username'])) {
            return new HtmlResponse($this->template->render('auth::login',	[
                'error' => 'The username cannot be empty',
            ]));
        }

        if (empty($params['password'])) {
        return	new	HtmlResponse($this->template->render('auth::login',	[
            'username' => $params['username'],
            'error' => 'The password cannot be empty',
            ]));
        }

        $this->authAdapter->setUsername($params['username']);
        $this->authAdapter->setPassword($params['password']);
        $result	= $this->auth->authenticate();

        if (!$result->isValid()) {
            return new HtmlResponse($this->template->render('auth::login', [
                'username' => $params['username'],
                'error' => 'The credentials provided are not valid',
            ]));
        }

        return	new	RedirectResponse('/admin');
    }
}