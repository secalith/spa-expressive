<?php

declare(strict_types=1);

namespace Content\Service;

class ContentService
{
    protected $tableArea;
    protected $tableBlock;
    protected $tableContent;

    public function __construct($tableArea,$tableBlock,$tableContent)
    {
        $this->tableArea = $tableArea;
        $this->tableBlock = $tableBlock;
        $this->tableContent = $tableContent;
    }

    public function getByUid($uid)
    {
        $templateData = $this->tableContent
            ->fetchBy($uid,'uid');

        return $templateData;
    }

    public function getByParentUid($uid)
    {
        $templateData = $this->tableContent
            ->fetchAllBy($uid,'parent_uid');

        return $templateData;
    }

    public function getAllBy($selector)
    {
        return $this->tableContent
            ->fetchAllBy($selector);
    }

    public function getChildBlocks($block,$t=false)
    {

        echo "For " . $block->getUid();

        $c = $this->getByParentUid($block->getUid());

        echo sprintf("Found %d children.", $c->count());

        $d = [];

        if( $c->count() > 0 ) {
            foreach($c as $b) {

                echo 'here';



                $d = $this->getChildBlocks($b,true);
                echo $b->count();
                $c->getBlock($b)->setBlock($d);
            }
        } else {
            echo 'nothing for ' . $block->getUid();
        }

        echo '<br />';

        return $c;

    }

    public function getBlock( \Block\Model\BlockModel $block)
    {
        $childChildBlocks = null;

        $childBlocks = $this->getByParentUid($block->getUid());

        if( $childBlocks !==false ) {
            foreach($childBlocks as $childBlock) {
                $childChildBlocks[] = $this->getChildBlocks($childBlock);
            }
        }

        return $childBlocks;

    }

    public function getByArea()
    {

    }
}