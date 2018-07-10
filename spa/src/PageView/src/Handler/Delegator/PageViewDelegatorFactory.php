<?php

namespace PageView\Handler\Delegator;

use Common\View\Helper;
use PageView\View\Model\ViewModel;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;
use PageView\Handler\PageViewAwareInterface;
use Zend\Expressive\Helper\UrlHelper;

class PageViewDelegatorFactory
{

    public function __invoke(ContainerInterface $container, string $name, callable $callback)
    {
        // The callback must implement
        if ( ! call_user_func($callback) instanceof PageViewAwareInterface) {
            return call_user_func($callback);
        } else {

            $requestedCallback = $callback();

            $routeName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();

            $pageView = new \Zend\View\Model\ViewModel();

            if (false!=$container->has("Page\\TableService"))
            {
                /* @var \Page\Model\PageModel $page */
                $pageData = $container->get(\Page\Service\PageService::class)->getPageByRouteName($routeName);
                $pageView->setVariable('page',$pageData);

                if( ! empty($pageData)) {

                    /* @var \PageTemplate\Model\PageTemplateModel $template */
                    $template = $container->get(\PageTemplate\Service\TemplateService::class)->getByUid($pageData->getTemplateUid());
                    $pageView->setVariable('template',$template);

                    if( ! empty($template)) {

                        $areaView = new \PageView\View\Model\ViewModel();

                        /* @var \Zend\Db\ResultSet\HydratingResultSet $templateAreas */
                        $templateAreas = $container->get(\Area\Service\AreaService::class)->mergeAreasByTemplateUid($template->getUid());

                        if( ! empty($templateAreas)) {
                            /* @var \Area\Model\AreaModel $area */
                            foreach($templateAreas as $area){

                                $areaView->setArea($area);

                                // get all blocks for the current area (with content)

                                $areaBlocks = $container->get(\PageView\Service\PageViewService::class)->getAllByArea($area);

                                if($areaBlocks) {
                                    foreach($areaBlocks->getBlock() as $areaBlock) {
                                        $areaView->getArea($area)->setBlock($areaBlock);
                                    }
                                }

                            } // endforeach $templateAreas
//var_dump($areaView);
                            $pageView->setVariable('area',$areaView);

                        }
                    }

                }
            }

            $requestedCallback->setPageView($pageView);

        }

        return $requestedCallback;

    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {}
}
