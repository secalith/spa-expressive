<?php

namespace Authentication\Handler;

use TableData\TableDataAwareInterface;
use TableData\TableDataAwareTrait;
use Form\FormAwareInterface;
use Form\FormAwareTrait;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use View\Controller\PageViewAwareInterface;
use View\Controller\PageViewAwareTrait;

class LoginProcessAction implements ServerMiddlewareInterface, FormAwareInterface
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

//        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
//        if (strlen($redirectUrl)>2048) {
//            throw new \Exception("Too long redirectUrl argument passed");
//        }

        $formPostData = $request->getParsedBody();
        $form = $this->getForm('form_login');
        $form->setData($formPostData);
        $this->addForm($form, 'form_login');

//        var_dump($this->getForm('form_login')->isValid());

        if (true===$this->getForm('form_login')->isValid()) {

            $data = $this->getForm('form_login')->getData();
            $this->authService->getAdapter()
                ->setEmail($data['email'])
                ->setPassword($data['password']);

            $result = $this->authService->authenticate();
//            var_dump($this->authManager->login($data['email'],$data['email']));
//            var_dump($result->getMessages());
            if ($result->isValid()) {

            }
            return new RedirectResponse('/');
// Perform login attempt.
            $result = $this->authManager->login($data['email'],
                $data['password'], $data['remember_me']);
            return new RedirectResponse('/');

            var_dump($result);
            // Check result.
//            if ($result->getCode()==Result::SUCCESS) {
//
//            }

        }

            if (! $this->template) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the zend-expressive skeleton application.',
                'docsUrl' => 'https://docs.zendframework.com/zend-expressive/',
            ]);
        }

        $data = [];

//        $data['pageView'] = $this->getPageView();

//        $data['pageData'] = $this->getTableData('users');
//        var_dump($data['pageView']);

//        $templateName = sprintf(
//            "%s::%s",
//            $data['pageView']->getVariable('template')->getLocation(),
//            $data['pageView']->getVariable('template')->getName()
//        );

//        $this->template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'pageView',$data['pageView']);
//        $this->template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'pageData',$data['pageData']);
//
        return new HtmlResponse($this->template->render('auth::login', $data));
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
