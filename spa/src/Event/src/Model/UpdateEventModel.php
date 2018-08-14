<?php

declare(strict_types=1);

namespace Event\Model;

class UpdateEventModel
{
    public $application_id;
    public $form_update;
    public $csrf;
    public $submit;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->application_id     = (!empty($data['application_id'])) ? $data['application_id'] : null;
        $this->csrf = (!empty($data['csrf'])) ? $data['csrf'] : null;
        $this->form_update = (!empty($data['form_update'])) ? $data['form_update'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_id'] = $this->application_id;
        $data['csrf'] = $this->csrf;
        $data['form_update'] = $this->form_update;

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
    public function getFormUpdate()
    {
        return $this->form_update;
    }

    /**
     * @param mixed $form_update
     * @return UpdateEventModel
     */
    public function setFormUpdate($form_update)
    {
        $this->form_update = $form_update;
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
