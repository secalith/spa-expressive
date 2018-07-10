<?php

declare(strict_types=1);

namespace User\Model;

class WriteFieldsetModel
{
    public $fieldset_user_profile;
    public $fieldset_user;
    public $fieldset_email_alias;
    public $fieldset_credentials;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_user_profile     = (!empty($data['fieldset_user_profile'])) ? $data['fieldset_user_profile'] : null;
        $this->fieldset_user     = (!empty($data['fieldset_user'])) ? $data['fieldset_user'] : null;
        $this->fieldset_email_alias = (!empty($data['fieldset_email_alias'])) ? $data['fieldset_email_alias'] : null;
        $this->fieldset_credentials = (!empty($data['fieldset_credentials'])) ? $data['fieldset_credentials'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_user'] = $this->fieldset_user;
        $data['fieldset_user_profile'] = $this->fieldset_user_profile;
        $data['fieldset_email_alias'] = $this->fieldset_email_alias;
        $data['fieldset_credentials'] = $this->fieldset_credentials;

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
    public function getFieldsetUserProfile()
    {
        return $this->fieldset_user_profile;
    }

    /**
     * @param mixed $fieldset_user_profile
     * @return WriteFieldsetModel
     */
    public function setFieldsetUserProfile($fieldset_user_profile)
    {
        $this->fieldset_user_profile = $fieldset_user_profile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetUser()
    {
        return $this->fieldset_user;
    }

    /**
     * @param mixed $fieldset_user
     * @return WriteFieldsetModel
     */
    public function setFieldsetUser($fieldset_user)
    {
        $this->fieldset_user = $fieldset_user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetEmailAlias()
    {
        return $this->fieldset_email_alias;
    }

    /**
     * @param mixed $fieldset_email_alias
     * @return WriteFieldsetModel
     */
    public function setFieldsetEmailAlias($fieldset_email_alias)
    {
        $this->fieldset_email_alias = $fieldset_email_alias;
        return $this;
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
     * @return WriteFieldsetModel
     */
    public function setFieldsetCredentials($fieldset_credentials)
    {
        $this->fieldset_credentials = $fieldset_credentials;
        return $this;
    }



}
