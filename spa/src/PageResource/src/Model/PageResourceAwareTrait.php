<?php

declare(strict_types=1);

namespace PageResource\Model;

trait PageResourceAwareTrait
{

    /**
     * @var array
     */
    protected $resources;

    public function setPageResource($resource,$index)
    {
        $this->resources[$index] = $resource;

        return $this;
    }

    public function getPageResource($index)
    {
        return$this->resources[$index];
    }
}
