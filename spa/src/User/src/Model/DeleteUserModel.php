<?php

declare(strict_types=1);

namespace User\Model;

class DeleteUserModel
{
    public $application_id;
    public $form_delete;
    public $csrf;
    public $submit;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->application_id     = (!empty($data['application_id'])) ? $data['application_id'] : null;
        $this->form_delete = (!empty($data['form_delete'])) ? $data['form_delete'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_id'] = $this->application_id;
        $data['form_delete'] = $this->form_delete;

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
    public function getFormDelete()
    {
        return $this->form_delete;
    }

    /**
     * @param mixed $form_delete
     * @return DeleteUserModel
     */
    public function setFormDelete($form_delete)
    {
        $this->form_delete = $form_delete;
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
