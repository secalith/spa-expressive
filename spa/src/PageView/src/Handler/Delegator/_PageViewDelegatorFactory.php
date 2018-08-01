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

                                return;

                                $rootBlocksDB = $container->get("Block\\TableService")
                                    ->fetchAllBy(['area_uid'=>$area->getUid(),'parent_uid'=>'0']);


                                if( null !== $rootBlocksDB ) {
                                    /* @var array $rootBlocksDB @var \Block\Model\BlockModel $rootBlock */
                                    foreach ($rootBlocksDB as $rootBlock) {
                                        $areaView->getArea($area)->setBlock($rootBlock);
// get content for the root block
                                        $rootBlockContent = $container->get("Content\\TableService")
                                            ->fetchAllBy(['block_uid' => $rootBlock->getUid(), 'parent_uid'=>'0']);
                                        // set content for the Root Block
                                        if( ! empty($rootBlockContent)) {
                                            foreach($rootBlockContent as $rootBlockContentData) {
                                                $areaView->getArea($area)->getBlock($rootBlock)->setContent($rootBlockContentData);
// get content for the content
                                                $rootBlockContentChild = $container->get("Content\\TableService")
                                                    ->fetchAllBy(['block_uid' => $rootBlock->getUid(), 'parent_uid'=>$rootBlockContentData->getUid()]);
                                                if( ! empty($rootBlockContentChild)) {
                                                    foreach ($rootBlockContentChild as $rootBlockContentChildData) {

//                                                        $formAttributes = json_decode($rootBlockContentChildData->getAttributes());

                                                        $areaView->getArea($area)->getBlock($rootBlock)->getContent($rootBlockContentData)->setContent($rootBlockContentChildData);
                                                    }
                                                }
                                            }
                                        }

// check for blocks (inside the Block)
                                        $childBlocksDB = $container->get("Block\\TableService")
                                            ->fetchAllBy(['area_uid'=>$area->getUid(),'parent_uid'=>$rootBlock->getUid()]);
                                        // get the child block for the Root Block
                                        if( ! empty($childBlocksDB)) {
                                            foreach($childBlocksDB as $childBlock){
                                                $areaView->getArea($area)->getBlock($rootBlock)->setBlock($childBlock);
// get content for childBlock
                                                $childBlockContent = $container->get("Content\\TableService")
                                                    ->fetchAllBy(['block_uid' => $childBlock->getUid(), 'parent_uid'=>'0']);
                                                if( ! empty($childBlockContent)) {
                                                    foreach($childBlockContent as $childBlockContentItem){
                                                        $areaView->getArea($area)->getBlock($rootBlock)->getBlock($childBlock)->setContent($childBlockContentItem);
//get (child) content for content
                                                        $childBlockContentChildContent = $container->get("Content\\TableService")
                                                            ->fetchAllBy(['block_uid' => $childBlock->getUid(), 'parent_uid'=>$childBlockContentItem->getUid()]);
                                                        if( null !== $childBlockContentChildContent) {
                                                            foreach($childBlockContentChildContent as $childBlockContentChildItem){
                                                                $areaView->getArea($area)->getBlock($rootBlock)->getBlock($childBlock)->getContent($childBlockContentItem)->setContent($childBlockContentChildItem);
// check for content-content content
                                                                $childBlockContentChildContentChild = $container->get("Content\\TableService")
                                                                    ->fetchAllBy(['block_uid' => $childBlock->getUid(), 'parent_uid'=>$childBlockContentChildItem->getUid()]);

                                                                if( ! empty($childBlockContentChildContentChild)) {
                                                                    foreach($childBlockContentChildContentChild as $childBlockContentChildContentChildContent) {
                                                                        $areaView->getArea($area)->getBlock($rootBlock)->getBlock($childBlock)->getContent($childBlockContentItem)->getContent($childBlockContentChildItem)->setContent($childBlockContentChildContentChildContent);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            } // endforeach $templateAreas

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
