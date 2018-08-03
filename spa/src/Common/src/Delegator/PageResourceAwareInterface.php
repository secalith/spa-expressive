<?php

declare(strict_types=1);

namespace Common\Delegator;

interface PageResourceAwareInterface
{
    public function addPageResource($resource = null,$index=null);

    public function getPageResource($name);

    public function getPageResources();
}
