<?php

declare(strict_types=1);

namespace Event\Model;

class WriteGroupFieldsetModel
{
    public $fieldset_event_group;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_event_group     = (!empty($data['fieldset_event_group'])) ?? null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_event_group'] = $this->fieldset_event_group;

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
    public function getFieldsetEventGroup()
    {
        return $this->fieldset_event_group;
    }

    /**
     * @param mixed $fieldset_event_group
     * @return WriteGroupFieldsetModel
     */
    public function setFieldsetEventGroup($fieldset_event_group)
    {
        $this->fieldset_event_group = $fieldset_event_group;
        return $this;
    }

}
