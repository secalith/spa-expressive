<?php

declare(strict_types=1);

namespace Auth\Handler;

use Auth\Service\CredentialsManager;
use	Auth\Adapter\AuthAdapter;
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

class RequestHandler implements RequestHandlerInterface, PageViewAwareInterface
{
    use PageViewAwareTrait;

    private $containerName;
    private $router;
    private	$authManager;
    private	$template;
    private	$redirect_urls;
    private	$credendtialsService;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        AuthenticationManager $authManager = null,
        array $redirect_urls = [],
        CredentialsManager $credendtialsService
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->authManager = $authManager;
        $this->redirect_urls = $redirect_urls;
        $this->credendtialsService = $credendtialsService;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $form = new \Auth\Form\RequestForm();

        if(strtoupper($request->getMethod()) === 'POST') {
            $postData = $request->getParsedBody();
            $form->setData($postData);
            if ($form->isValid()) {
                // Form is valid
                $formData = $form->getData();

                $email = $formData->getFormRequest()->getFieldsetCredentials()->getEmail();

                if($this->credendtialsService->checkUserExists($email)) {
                    // generate reset token

                    $data['email'] = $email;
                    $data['token'] = \Zend\Math\Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
                    $data['status'] = 1;
                    $data['created'] = date('Y-m-d H:i:s');

                    $model = new \Auth\Model\CredentialsResetTableModel($data);

                    $this->credendtialsService->saveResetToken($model);


                    $subject = 'Password Reset';

                    $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
                    $passwordResetUrl = 'http://' . $httpHost . '/set-password?token=' . $data['token'];

                    $body = 'Please follow the link below to reset your password:\n';
                    $body .= "$passwordResetUrl\n";
                    $body .= "If you haven't asked to reset your password, please ignore this message.\n";
//                    ini_set('sendmail_from', 'jan@kowalski.name');
                    // Send email to user.
                    (mail($email, $subject, $body));

                }

                $form = new \Auth\Form\RequestForm();

            }

        }

        return	new	HtmlResponse($this->template->render('auth::request',['forms'=>['form_request'=>$form]]));
    }
}