<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class FormComposerHandler implements RequestHandlerInterface
{
    private $containerName;

    private $router;

    private $template;

    private $form;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        $form
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->form = $form;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if (! $this->template) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the zend-expressive skeleton application.',
                'docsUrl' => 'https://docs.zendframework.com/zend-expressive/',
            ]);
        }

        if(strtoupper($request->getMethod())==="POST") {

            $postData = $request->getParsedBody();

            $this->form->setData($postData);

            $this->form->isValid();

            var_dump($this->form->isValid());

            var_dump($this->form->getData());
            var_dump($postData);

        }

        return new HtmlResponse($this->template->render('app::form-test', ['form'=>$this->form]));
    }
}
