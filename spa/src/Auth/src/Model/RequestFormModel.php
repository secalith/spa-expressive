<?php

declare(strict_types=1);

namespace Auth\Model;

class RequestFormModel
{
    public $application_id;
    public $form_request;
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
        $this->form_request = ( array_key_exists('form_request',$data))
            ? $data['form_request']
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
        $data['form_request'] = $this->form_request;
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
    public function getFormRequest()
    {
        return $this->form_request;
    }

    /**
     * @param mixed $form_request
     * @return RequestFormModel
     */
    public function setFormRequest($form_request)
    {
        $this->form_request = $form_request;
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