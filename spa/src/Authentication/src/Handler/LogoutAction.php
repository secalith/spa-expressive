<?php

namespace Authentication\Handler;

use Zend\Diactoros\Response\RedirectResponse;
use Form\FormAwareInterface;
use Form\FormAwareTrait;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;

class LogoutAction implements ServerMiddlewareInterface, FormAwareInterface
{

    use FormAwareTrait;

    private $router;

    private $template;

    private $page_view;

    private $authManager;
    private $authService;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, $authManager=null,$authService=null)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->authManager = $authManager;
        $this->authService = $authService;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
//echo 6;
        $this->authManager->logout();

//        $this->getSessionStorage()->forgetMe();

        return new RedirectResponse('/');

        return new HtmlResponse($this->template->render('auth::logout_success'));
    }

    /**
     * @return mixed
     */
    public function getPageView()
    {
        return $this->page_view;
    }

    /**
     * @param mixed $page_view
     * @return HomePageAction
     */
    public function setPageView($page_view)
    {
        $this->page_view = $page_view;
        return $this;
    }

}
