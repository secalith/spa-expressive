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
use PageResource\Delegator\PageResourceAwareInterface;
use PageResource\Delegator\PageResourceAwareTrait;

class PageHandler
    implements RequestHandlerInterface,
        PageViewAwareInterface,
        PageResourceAwareInterface
{

    use PageViewAwareTrait;
    use PageResourceAwareTrait;

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

        if( null !== $this->getPageResources() )
        {
            $pageResources = $this->getPageResources();

            foreach($pageResources as $pageResourceType=>$pageResource)
            {
                if($pageResourceType=='form')
                {
                    if(strtoupper($request->getMethod())==="POST")
                    {
                        $postData = $request->getParsedBody();

                        foreach($pageResource as $pResName=>$pResource)
                        {
                            if(array_key_exists($pResName,$postData))
                            {
                                $pageResources[$pageResourceType][$pResName]['data']->setData($postData);
                                $v = $pageResources[$pageResourceType][$pResName]['data']->isValid();

                                if($v===true) {

                                    // save

                                    $saveService = $pResource['service'];
                                    $saveMethod = $pResource['parameters']['save']['service']['method'];


                                    $saveService->{$saveMethod}($pageResources[$pageResourceType][$pResName]['data']->getData());

                                    $pageResources[$pageResourceType][$pResName]['request']['post']['submitted'] = true;
                                }

                            }
                        }

                    }
                }
            }

            $data['pageView']->setVariable('page_resource',$pageResources);
        }

        $data['pageView']->setVariable('layout',$data['pageView']->getVariable('page')->getPageLayout());

        $this->template->addDefaultParam(Template\TemplateRendererInterface::TEMPLATE_ALL,'pageView',$data['pageView']);

        return new HtmlResponse($this->template->render($templateName, $data['pageView']));
    }

}
