<?php

declare(strict_types=1);

namespace PageRoute\Model;

class RouteWriteFieldsetModel
{
    public $fieldset_route;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_route     = (!empty($data['fieldset_route'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_route'] = $this->fieldset_route;

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

}
