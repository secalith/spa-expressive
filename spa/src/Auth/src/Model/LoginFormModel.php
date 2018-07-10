<?php

declare(strict_types=1);

namespace Auth\Model;

class LoginFormModel
{
    public $application_id;
    public $form_login;
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
        $this->form_login = ( array_key_exists('form_login',$data))
            ? $data['form_login']
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
        $data['form_login'] = $this->form_login;
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
    public function getFormLogin()
    {
        return $this->form_login;
    }

    /**
     * @param mixed $form_login
     * @return LoginFormModel
     */
    public function setFormLogin($form_login)
    {
        $this->form_login = $form_login;
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