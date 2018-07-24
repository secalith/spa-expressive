<?php

declare(strict_types=1);

namespace Page\Model;

class WriteFieldsetModel
{
    public $fieldset_page;
    public $fieldset_route;
    public $fieldset_router;
    public $fieldset_template;
    public $collection_area;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_page     = (!empty($data['fieldset_page'])) ?? null;
        $this->fieldset_route     = (!empty($data['fieldset_route'])) ?? null;
        $this->fieldset_router     = (!empty($data['fieldset_router'])) ?? null;
        $this->fieldset_template     = (!empty($data['fieldset_template'])) ?? null;
        $this->collection_area     = (!empty($data['collection_area'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_page'] = $this->fieldset_page;
        $data['fieldset_route'] = $this->fieldset_route;
        $data['fieldset_router'] = $this->fieldset_router;
        $data['fieldset_template'] = $this->fieldset_template;
        $data['collection_area'] = $this->collection_area;

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getFieldsetPage()
    {
        return $this->fieldset_page;
    }

    /**
     * @param mixed $fieldset_page
     * @return WriteFieldsetModel
     */
    public function setFieldsetPage($fieldset_page)
    {
        $this->fieldset_page = $fieldset_page;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetRoute()
    {
        return $this->fieldset_route;
    }

    /**
     * @param mixed $fieldset_route
     * @return WriteFieldsetModel
     */
    public function setFieldsetRoute($fieldset_route)
    {
        $this->fieldset_route = $fieldset_route;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetRouter()
    {
        return $this->fieldset_router;
    }

    /**
     * @param mixed $fieldset_router
     * @return WriteFieldsetModel
     */
    public function setFieldsetRouter($fieldset_router)
    {
        $this->fieldset_router = $fieldset_router;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetTemplate()
    {
        return $this->fieldset_template;
    }

    /**
     * @param mixed $fieldset_template
     * @return WriteFieldsetModel
     */
    public function setFieldsetTemplate($fieldset_template)
    {
        $this->fieldset_template = $fieldset_template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCollectionArea()
    {
        return $this->collection_area;
    }

    /**
     * @param mixed $collection_area
     * @return WriteFieldsetModel
     */
    public function setCollectionArea($collection_area)
    {
        $this->collection_area = $collection_area;
        return $this;
    }

}
