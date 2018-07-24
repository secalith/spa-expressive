<?php

declare(strict_types=1);

namespace PageResource\Model;

interface PageResourceAwareInterface
{
    public function setPageResource($resource,$index) : PageResourceAwareInterface;
    public function getPageResource($index);
}
