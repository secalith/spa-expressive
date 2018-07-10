<?php

declare(strict_types=1);

namespace Import\Handler;

use Common\Delegator\ApplicationFormRouteAwareInterface;
use Common\Delegator\ApplicationFormRouteAwareTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ImportPage implements RequestHandlerInterface, ApplicationFormRouteAwareInterface
{
    use ApplicationFormRouteAwareTrait;
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'import::import-page',
            [] // parameters to pass to template
        ));
    }
}
