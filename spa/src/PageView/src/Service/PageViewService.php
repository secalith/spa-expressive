<?php

declare(strict_types=1);

namespace PageView\Service;

use Area\Model\AreaModel;
use Block\Model\BlockModel;
use Content\Model\ContentModel;

class PageViewService
{
    protected $tablePage;
    protected $tableTemplate;
    protected $tableArea;
    protected $serviceBlock;
    protected $tableContent;
    protected $current_language;

    public function __construct($tablePage,$tableTemplate,$tableArea,$serviceBlock,$serviceContent,$currentLanguage)
    {
        $this->tablePage = $tablePage;
        $this->tableTemplate = $tableTemplate;
        $this->tableArea = $tableArea;
        $this->serviceBlock = $serviceBlock;
        $this->serviceContent = $serviceContent;
        $this->current_language = $currentLanguage;
    }

    public function getPageByRouteName($route_name)
    {
        /* @var \Page\Model\PageModel $page */
        $page = $this->tablePage->fetchBy($route_name,'name');

        return $page;
    }

    public function getRootBlocksByArea(AreaModel $areaModel)
    {
        $pageView = new \PageView\View\Model\ViewModel();

        // get the root blocks
        $rootBlocksByArea = $this->serviceBlock->getAllBy(['area_uid'=>$areaModel->getUid(),'parent_uid'=>'0','status'=>'1']);

        if($rootBlocksByArea) {
            foreach($rootBlocksByArea as $rootBlock) {
                $pageView->setBlock($rootBlock);

                $rootContentByBlock = $this->serviceContent->getAllBy(['block_uid'=>$rootBlock->getUid(),'parent_uid'=>'0','status'=>'1','language'=>$this->current_language]);

                if($rootContentByBlock) {
                    foreach($rootContentByBlock as $rootContent) {

                        $pageView->getBlock($rootBlock)->setContent($rootContent);
                    }
                }

                $t = $this->serviceBlock->getAllBy(['parent_uid'=>$rootBlock->getUid(),'status'=>'1']);
                if($t) {
                    foreach($t as $r) {
                        $pageView->getBlock($rootBlock)->setBlock($this->getBlocksByBlock($r));
                    }
                }
            }
        }

        return $pageView;
    }

    public function getBlocksByBlock(BlockModel $blockModel)
    {
        $rr = new \PageView\View\Model\ViewModel($blockModel);

        $rootContentByBlock = $this->serviceContent->getAllBy(['block_uid'=>$blockModel->getUid(),'parent_uid'=>'0','status'=>'1']);
        if($rootContentByBlock) {
            foreach($rootContentByBlock as $rootContent) {
                $rr->setContent($rootContent);
            }
        }


        $rootBlocksByBlock = $this->serviceBlock->getAllBy(['parent_uid'=>$blockModel->getUid(),'status'=>'1']);

        if($rootBlocksByBlock) {
            foreach($rootBlocksByBlock as $rootBlockByBlock) {
                $rr->setBlock($this->getBlocksByBlock($rootBlockByBlock));

                $rootContentByBlock = $this->serviceContent->getAllBy(['block_uid'=>$rootBlockByBlock->getUid(),'parent_uid'=>'0','status'=>'1','language'=>$this->current_language]);

                if($rootContentByBlock) {
                    foreach($rootContentByBlock as $rootContent) {
                        $rr->getBlock($rootBlockByBlock)->setContent($rootContent);
                    }
                }

            }
        }

        return $rr;
    }

    public function getContentByContent(ContentModel $contentModel)
    {

    }

    public function getAllByArea(AreaModel $areaModel)
    {
        // get root blocks
        $rootBlocksByArea = $this->getRootBlocksByArea($areaModel);

        return $rootBlocksByArea;
    }

    public function getAllByBlock(\Block\Model\BlockModel $blockModel)
    {
        $blockView = new \PageView\View\Model\ViewModel($blockModel);

        $otherBlocksByBlock = $this->serviceBlock->getAllBy(['parent_uid'=>$blockModel->getUid()]);

        if($otherBlocksByBlock->count() > 0 ) {
            foreach($otherBlocksByBlock as $otherBlockByBlock) {
                $blockView->setBlock($otherBlockByBlock);
                $otherOtherBlocks = $this->getAllByBlock($otherBlockByBlock);

                $blockView->getBlock($otherBlockByBlock->getUid())->setBlock($otherOtherBlocks);
            }
        }

        return $blockView;

    }
}