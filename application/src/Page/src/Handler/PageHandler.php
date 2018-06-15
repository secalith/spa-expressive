<?php

declare(strict_types=1);

namespace Page\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\ZendView\ZendViewRenderer;
use PageView\Handler\PageViewAwareInterface;
use PageView\Handler\PageViewAwareTrait;

class PageHandler implements RequestHandlerInterface, PageViewAwareInterface
{
    use PageViewAwareTrait;

    private $containerName;

    private $router;

    private $template;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
    }
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = [];

        $data['pageView'] = $this->getPageView();

        $templateName = sprintf(
            "%s::%s",
            $data['pageView']->getVariable('template')->getLocation(),
            $data['pageView']->getVariable('template')->getName()
        );

        $this->template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'pageView',$data['pageView']);
//var_dump($data);
        return new HtmlResponse($this->template->render($templateName, $data['pageView']));
    }

}
