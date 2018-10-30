<?php

declare(strict_types=1);

namespace Auth\Handler;

use	Psr\Http\Message\ServerRequestInterface;
use	Zend\Authentication\AuthenticationService;
use	Zend\Diactoros\Response\HtmlResponse;
use	Zend\Diactoros\Response\RedirectResponse;
use	Zend\Expressive\Template\TemplateRendererInterface;
use Auth\Service\AuthenticationManager;
use PageView\Handler\PageViewAwareInterface;
use PageView\Handler\PageViewAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class ResetCodeHandler implements RequestHandlerInterface, PageViewAwareInterface
{
    use PageViewAwareTrait;

    private $containerName;
    private $router;
    private	$authManager;
    private	$template;
    private	$redirect_urls;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        AuthenticationManager $authManager = null,
        array $redirect_urls = []
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->authManager = $authManager;
        $this->redirect_urls = $redirect_urls;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $loginForm = new \Auth\Form\ResetCodeForm();

        if(strtoupper($request->getMethod()) === 'POST') {
            $postData = $request->getParsedBody();
            $loginForm->setData($postData);
            if ($loginForm->isValid()) {
                // Form is valid
                $formData = $loginForm->getData();

                $result = $this->authManager->login(
                    $formData->getFormLogin()->getFieldsetCredentials()->getEmail(),
                    $formData->getFormLogin()->getFieldsetCredentials()->getPassword(),
                    $formData->getFormLogin()->getFieldsetRememberMe()->getRememberMe()
                );

                if (!$result->isValid()) {
                    return new HtmlResponse($this->template->render('auth::reset-code', [
//                        'username' => $params['username'],
                        'error' => 'The credentials provided are not valid',
                        'forms'=>['form_login'=>$loginForm]
                    ]));
                } else {
                    return new RedirectResponse($this->redirect_urls['success']);
                }

            }

        }

        return	new	HtmlResponse($this->template->render('auth::reset-code',['forms'=>['form_reset_code'=>$loginForm]]));
    }
}