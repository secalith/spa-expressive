<?php

declare(strict_types=1);

namespace Content\Model;

class WriteFieldsetModel
{
    public $fieldset_content;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_content = (!empty($data['fieldset_content'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_content'] = $this->fieldset_content;

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
    public function getFieldsetContent()
    {
        return $this->fieldset_content;
    }

    /**
     * @param mixed $fieldset_content
     * @return WriteFieldsetModel
     */
    public function setFieldsetContent($fieldset_content)
    {
        $this->fieldset_content = $fieldset_content;
        return $this;
    }

}
