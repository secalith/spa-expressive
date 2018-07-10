<?php

declare(strict_types=1);

namespace Common\Handler;

use Common\Handler\DataAwareInterface;
use Common\Handler\DataAwareTrait;
use Common\Paginator\PaginatorAwareInterface;
use Common\Paginator\PaginatorAwareTrait;
use Stock\Service\StockServiceAwareTrait;
use Product\Service\ProductService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stock\Form\StockBarcodeForm;
use Stock\Service\StockService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Paginator\Paginator;
use Zend\Paginator\ScrollingStyle\Sliding;

class ListHandler implements RequestHandlerInterface, PaginatorAwareInterface, DataAwareInterface
{
    use PaginatorAwareTrait;
    use DataAwareTrait;

    private $containerName;

    private $router;

    private $template;

    private $urlHelper;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        Paginator $paginator = null,
        UrlHelper $urlHelper = null
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->setPaginator($paginator);
        $this->urlHelper = $urlHelper;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $this->getPaginator()
            ->setCurrentPageNumber($request->getAttribute('page'))
            ->setDefaultItemCountPerPage(25)
        ;
        $this->addData($this->getPaginator(),'paginator');

        return new HtmlResponse($this->template->render($this->getData('template'), $this->getData()));
    }
}
