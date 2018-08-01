<?php

declare(strict_types=1);

namespace Event\Model;

class WriteFieldsetModel
{
    public $fieldset_event;
    public $fieldset_event_details;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_event     = (!empty($data['fieldset_event'])) ?? null;
        $this->fieldset_event_details     = (!empty($data['fieldset_event_details'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_event'] = $this->fieldset_event;
        $data['fieldset_event_details'] = $this->fieldset_event_details;

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
    public function getFieldsetEvent()
    {
        return $this->fieldset_event;
    }

    /**
     * @param mixed $fieldset_event
     * @return WriteFieldsetModel
     */
    public function setFieldsetEvent($fieldset_event)
    {
        $this->fieldset_event = $fieldset_event;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetEventDetails()
    {
        return $this->fieldset_event_details;
    }

    /**
     * @param mixed $fieldset_event_details
     * @return WriteFieldsetModel
     */
    public function setFieldsetEventDetails($fieldset_event_details)
    {
        $this->fieldset_event_details = $fieldset_event_details;
        return $this;
    }

}
