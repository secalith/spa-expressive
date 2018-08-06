<?php

declare(strict_types=1);

namespace Petition\Model;

class PetitionCreateModel
{
    public $application_id;
    public $form_create;
    public $csrf;
    public $submit;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->application_id     = (!empty($data['application_id'])) ? $data['application_id'] : null;
        $this->form_create = (!empty($data['form_create'])) ? $data['form_create'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_id'] = $this->application_id;
        $data['form_create'] = $this->form_create;

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
    public function getFormCreate()
    {
        return $this->form_create;
    }

    /**
     * @param mixed $form_create
     * @return CreateUserModel
     */
    public function setFormCreate($form_create)
    {
        $this->form_create = $form_create;
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
