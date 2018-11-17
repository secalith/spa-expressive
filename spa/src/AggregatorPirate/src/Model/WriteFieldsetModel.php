<?php

declare(strict_types=1);

namespace AggregatorPirate\Model;

class WriteFieldsetModel
{
    public $fieldset_entry_item;
    public $fieldset_yt_entry_item;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_entry_item     = (!empty($data['fieldset_entry_item'])) ?? null;
        $this->fieldset_yt_entry_item     = (!empty($data['fieldset_yt_entry_item'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_entry_item'] = $this->fieldset_entry_item;
        $data['fieldset_yt_entry_item'] = $this->fieldset_yt_entry_item;

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
    public function getFieldsetEntryItem()
    {
        return $this->fieldset_entry_item;
    }

    /**
     * @param mixed $fieldset_entry_item
     * @return WriteFieldsetModel
     */
    public function setFieldsetEntryItem($fieldset_entry_item)
    {
        $this->fieldset_entry_item = $fieldset_entry_item;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetYtEntryItem()
    {
        return $this->fieldset_yt_entry_item;
    }

    /**
     * @param mixed $fieldset_yt_entry_item
     * @return WriteFieldsetModel
     */
    public function setFieldsetYtEntryItem($fieldset_yt_entry_item)
    {
        $this->fieldset_yt_entry_item = $fieldset_yt_entry_item;
        return $this;
    }

}
