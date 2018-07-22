<?php

declare(strict_types=1);

namespace User\Model;

class ReadUserModel
{
    public $application_id;
    public $form_read;
    public $csrf;
    public $submit;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->application_id     = (!empty($data['application_id'])) ? $data['application_id'] : null;
        $this->form_read = (!empty($data['form_read'])) ? $data['form_read'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_id'] = $this->application_id;
        $data['form_read'] = $this->form_read;

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
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @param mixed $application_id
     * @return CreateUserModel
     */
    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormRead()
    {
        return $this->form_read;
    }

    /**
     * @param mixed $form_create
     * @return CreateUserModel
     */
    public function setFormRead($form_read)
    {
        $this->form_read = $form_read;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCsrf()
    {
        return $this->csrf;
    }

    /**
     * @param mixed $csrf
     * @return CreateUserModel
     */
    public function setCsrf($csrf)
    {
        $this->csrf = $csrf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubmit()
    {
        return $this->submit;
    }

    /**
     * @param mixed $submit
     * @return CreateUserModel
     */
    public function setSubmit($submit)
    {
        $this->submit = $submit;
        return $this;
    }

}
