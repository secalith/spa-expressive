<?php

declare(strict_types=1);

namespace Petition\Model;

class PetitionModel
{
    public $uid;
    public $application_uid;
    public $site_uid;
    public $group;
    public $name;
    public $name_global;

    public $country;
    public $comm;
    public $status;

    public $created;
    public $updated;

    /**
     * PageModel constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid = ( array_key_exists('uid',$data)) ? $data['uid'] : null;
        $this->application_uid = ( array_key_exists('application_uid',$data)) ? $data['application_uid'] : null;
        $this->site_uid = ( array_key_exists('site_uid',$data)) ? $data['site_uid'] : null;
        $this->group = ( array_key_exists('group',$data)) ? $data['group'] : null;
        $this->name = ( array_key_exists('name',$data)) ? $data['name'] : null;
        $this->name_global = ( array_key_exists('name_global',$data)) ? $data['name_global'] : null;

        $this->country = ( array_key_exists('country',$data)) ? $data['country'] : null;
        $this->comm = ( array_key_exists('comm',$data)) ? $data['comm'] : null;
        $this->status = ( array_key_exists('status',$data)) ? $data['status'] : null;

        $this->created = ( array_key_exists('created',$data)) ? $data['created'] : null;
        $this->updated = ( array_key_exists('updated',$data)) ? $data['updated'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['application_uid'] = $this->application_uid;
        $data['site_uid'] = $this->site_uid;
        $data['group'] = $this->group;
        $data['name'] = $this->name;
        $data['name_global'] = $this->name_global;

        $data['country'] = $this->country;
        $data['comm'] = $this->comm;
        $data['status'] = $this->status;

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
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return PetitionModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
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
     * @return PetitionModel
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
     * @return PetitionModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     * @return PetitionModel
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PetitionModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameGlobal()
    {
        return $this->name_global;
    }

    /**
     * @param mixed $name_global
     * @return PetitionModel
     */
    public function setNameGlobal($name_global)
    {
        $this->name_global = $name_global;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return PetitionModel
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * @param mixed $comm
     * @return PetitionModel
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return PetitionModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return PetitionModel
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
     * @return PetitionModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
