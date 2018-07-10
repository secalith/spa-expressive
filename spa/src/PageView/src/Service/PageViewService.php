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

    public function __construct($tablePage,$tableTemplate,$tableArea,$serviceBlock,$serviceContent)
    {
        $this->tablePage = $tablePage;
        $this->tableTemplate = $tableTemplate;
        $this->tableArea = $tableArea;
        $this->serviceBlock = $serviceBlock;
        $this->serviceContent = $serviceContent;
    }

    public function getPageByRouteName($route_name)
    {
        /* @var \Page\Model\PageModel $page */
        $page = $this->tablePage->fetchBy($route_name,'name');

        return $page;
    }

    public function getRootBlocksByArea(AreaModel $areaModel)
    {
        $rr = new \PageView\View\Model\ViewModel();

        $rootBlocksByArea = $this->serviceBlock->getAllBy(['area_uid'=>$areaModel->getUid(),'parent_uid'=>'0','status'=>'1']);


        if($rootBlocksByArea) {
            foreach($rootBlocksByArea as $bblock) {
                $rr->setBlock($bblock);

                $rootContentByBlock = $this->serviceContent->getAllBy(['block_uid'=>$areaModel->getUid(),'parent_uid'=>'0','status'=>'1']);

                if($rootContentByBlock) {
                    foreach($rootContentByBlock as $rootContent) {
                        $rr->getBlock($bblock)->setContent($rootContent);
                    }
                }

                $t = $this->serviceBlock->getAllBy(['parent_uid'=>$bblock->getUid(),'status'=>'1']);
                if($t) {
                    foreach($t as $r) {
                        $rr->getBlock($bblock)->setBlock($this->getBlocksByBlock($r));
                    }
                }
            }
        }

        return $rr;
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

                $rootContentByBlock = $this->serviceContent->getAllBy(['block_uid'=>$rootBlockByBlock->getUid(),'parent_uid'=>'0','status'=>'1']);

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