<?php
namespace Common\Settings\Model;

class Model
{
    public $name;
    public $value;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return SettingsModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return SettingsModel
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function exchangeArray($data)
    {
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->value = (!empty($data['value'])) ? $data['value'] : null;
    }

}