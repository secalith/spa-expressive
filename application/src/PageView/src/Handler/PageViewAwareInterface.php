<?php

declare(strict_types=1);

namespace PageView\Handler;

interface PageViewAwareInterface
{

    public function setPageView($data);

    public function getPageView();

}