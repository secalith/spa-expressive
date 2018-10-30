<?php

declare(strict_types=1);

namespace Auth\Model;

class RequestModel
{
    public $fieldset_credentials;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->fieldset_credentials = ( array_key_exists('fieldset_credentials',$data))
            ? $data['fieldset_credentials']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_credentials'] = $this->fieldset_credentials;

        return $data;
    }

    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getFieldsetCredentials()
    {
        return $this->fieldset_credentials;
    }

    /**
     * @param mixed $fieldset_credentials
     * @return RequestModel
     */
    public function setFieldsetCredentials($fieldset_credentials)
    {
        $this->fieldset_credentials = $fieldset_credentials;
        return $this;
    }

}