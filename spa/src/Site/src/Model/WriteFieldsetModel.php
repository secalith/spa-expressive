<?php

declare(strict_types=1);

namespace Site\Model;

class WriteFieldsetModel
{
    public $fieldset_site;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_site = (!empty($data['fieldset_site'])) ?? null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_site'] = $this->fieldset_site;

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
    public function getFieldsetSite()
    {
        return $this->fieldset_site;
    }

    /**
     * @param mixed $fieldset_site
     * @return WriteFieldsetModel
     */
    public function setFieldsetSite($fieldset_site)
    {
        $this->fieldset_site = $fieldset_site;
        return $this;
    }
}
