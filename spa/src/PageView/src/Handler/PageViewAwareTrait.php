<?php

declare(strict_types=1);

namespace PageView\Handler;

trait PageViewAwareTrait
{
    protected $page_view;

    public function setPageView($data)
    {
        $this->page_view = $data;
    }

    public function getPageView()
    {
        return $this->page_view;
    }
}