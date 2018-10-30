<?php

declare(strict_types=1);

namespace Auth\Model;

class ResetCodeFormModel
{
    public $application_id;
    public $form_reset_code;
    public $security;
    public $send;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->application_id = ( array_key_exists('application_id',$data))
            ? $data['application_id']
            : null;
        $this->form_reset_code = ( array_key_exists('form_reset_code',$data))
            ? $data['form_reset_code']
            : null;
        $this->security = ( array_key_exists('security',$data))
            ? $data['security']
            : null;
        $this->send = ( array_key_exists('send',$data))
            ? $data['send']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_id'] = $this->application_id;
        $data['form_reset_code'] = $this->form_reset_code;
        $data['security'] = $this->security;
        $data['send'] = $this->send;

        return $data;
    }

    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @param mixed $application_id
     * @return LoginFormModel
     */
    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormResetCode()
    {
        return $this->form_reset_code;
    }

    /**
     * @param mixed $form_reset_code
     * @return ResetCodeFormModel
     */
    public function setFormResetCode($form_reset_code)
    {
        $this->form_reset_code = $form_reset_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * @param mixed $security
     * @return LoginFormModel
     */
    public function setSecurity($security)
    {
        $this->security = $security;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * @param mixed $send
     * @return LoginFormModel
     */
    public function setSend($send)
    {
        $this->send = $send;
        return $this;
    }

}