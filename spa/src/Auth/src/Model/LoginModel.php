<?php

declare(strict_types=1);

namespace Auth\Model;

class LoginModel
{
    public $fieldset_credentials;
    public $fieldset_remember_me;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->fieldset_credentials = ( array_key_exists('fieldset_credentials',$data))
            ? $data['fieldset_credentials']
            : null;
        $this->fieldset_remember_me = ( array_key_exists('fieldset_remember_me',$data))
            ? $data['fieldset_remember_me']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_credentials'] = $this->fieldset_credentials;
        $data['fieldset_remember_me'] = $this->fieldset_remember_me;

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
    public function getFieldsetRememberMe()
    {
        return $this->fieldset_remember_me;
    }

    /**
     * @param mixed $fieldset_remember_me
     * @return LoginModel
     */
    public function setFieldsetRememberMe($fieldset_remember_me)
    {
        $this->fieldset_remember_me = $fieldset_remember_me;
        return $this;
    }

}