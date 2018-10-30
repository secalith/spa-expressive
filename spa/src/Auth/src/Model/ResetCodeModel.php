<?php

declare(strict_types=1);

namespace Auth\Model;

class ResetCodeModel
{
    public $fieldset_credentials;
    public $fieldset_code;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->fieldset_credentials = ( array_key_exists('fieldset_credentials',$data))
            ? $data['fieldset_credentials']
            : null;
        $this->fieldset_code = ( array_key_exists('fieldset_code',$data))
            ? $data['fieldset_code']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_credentials'] = $this->fieldset_credentials;
        $data['fieldset_code'] = $this->fieldset_code;

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
     * @return LoginModel
     */
    public function setFieldsetCredentials($fieldset_credentials)
    {
        $this->fieldset_credentials = $fieldset_credentials;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetCode()
    {
        return $this->fieldset_code;
    }

    /**
     * @param mixed $fieldset_code
     * @return ResetCodeModel
     */
    public function setFieldsetCode($fieldset_code)
    {
        $this->fieldset_code = $fieldset_code;
        return $this;
    }

}