<?php


namespace Shrt\Model;

class ShortenModel
{
    public $application_uid;
    public $site_uid;
    public $form_create;
    public $created;
    public $updated;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->application_uid     = (!empty($data['application_uid'])) ? $data['application_uid'] : null;
        $this->site_uid = (!empty($data['site_uid'])) ? $data['site_uid'] : null;
        $this->form_create = (!empty($data['form_create'])) ? $data['form_create'] : null;
        $this->created = (!empty($data['site_uid'])) ? $data['created'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['application_uid'] = $this->application_uid;
        $data['site_uid'] = $this->site_uid;
        $data['form_create'] = $this->form_create;
        $data['created'] = $this->created;
        $data['updated'] = $this->updated;

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
    public function getApplicationUid()
    {
        return $this->application_uid;
    }

    /**
     * @param mixed $application_uid
     * @return ShortenModel
     */
    public function setApplicationUid($application_uid)
    {
        $this->application_uid = $application_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteUid()
    {
        return $this->site_uid;
    }

    /**
     * @param mixed $site_uid
     * @return ShortenModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
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
     * @return ShortenModel
     */
    public function setFormCreate($form_create)
    {
        $this->form_create = $form_create;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return ShortenModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return ShortenModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
