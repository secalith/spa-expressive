<?php

namespace PageResource\Delegator;

trait PageResourceAwareTrait
{
    /**
     * @var array|null
     */
    protected $pageResource;

    public function addPageResource($resource = null,$index=null)
    {
        $this->pageResource[$index] = $resource;
        return $this;
    }

    public function getPageResource($name)
    {
        if (array_key_exists($name, $this->pageResource)) {
            return $this->pageResource[$name];
        }
        return null;
    }

    public function getPageResources()
    {
        return $this->pageResource;
    }

}
