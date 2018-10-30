<?php

declare(strict_types=1);

namespace Petition\Model;

class WriteFieldsetModel
{
    public $fieldset_petition;
    public $fieldset_petition_translation;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_petition = (!empty($data['fieldset_petition'])) ?? null;
        $this->fieldset_petition_translation = (!empty($data['fieldset_petition_translation'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_petition'] = $this->fieldset_petition;
        $data['fieldset_petition_translation'] = $this->fieldset_petition_translation;

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
    public function getFieldsetPetition()
    {
        return $this->fieldset_petition;
    }

    /**
     * @param mixed $fieldset_petition
     * @return WriteFieldsetModel
     */
    public function setFieldsetPetition($fieldset_petition)
    {
        $this->fieldset_petition = $fieldset_petition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetPetitionTranslation()
    {
        return $this->fieldset_petition_translation;
    }

    /**
     * @param mixed $fieldset_petition_translation
     * @return WriteFieldsetModel
     */
    public function setFieldsetPetitionTranslation($fieldset_petition_translation)
    {
        $this->fieldset_petition_translation = $fieldset_petition_translation;
        return $this;
    }

}
