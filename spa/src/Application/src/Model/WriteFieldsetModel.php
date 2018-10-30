<?php

declare(strict_types=1);

namespace Application\Model;

class WriteFieldsetModel
{
    public $fieldset_application;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_application     = (!empty($data['fieldset_application'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_application'] = $this->fieldset_application;

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
    public function getFieldsetApplication()
    {
        return $this->fieldset_application;
    }

    /**
     * @param mixed $fieldset_event
     * @return WriteFieldsetModel
     */
    public function setFieldsetApplication($fieldset_application)
    {
        $this->fieldset_application = $fieldset_application;
        return $this;
    }

}
