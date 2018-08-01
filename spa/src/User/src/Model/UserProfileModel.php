<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace User\Model;

class UserProfileModel
{
    public $uid;
    public $name_first;
    public $name_last;
    public $organization;
    public $created;
    public $updated;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->name_first = (!empty($data['name_first'])) ? $data['name_first'] : null;
        $this->name_last = (!empty($data['name_last'])) ? $data['name_last'] : null;
        $this->organization = (!empty($data['organization'])) ? $data['organization'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['name_first'] = $this->name_first;
        $data['name_last'] = $this->name_last;
        $data['organization'] = $this->organization;
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
     * @return UserProfileModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameFirst()
    {
        return $this->name_first;
    }

    /**
     * @param mixed $name_first
     * @return UserProfileModel
     */
    public function setNameFirst($name_first)
    {
        $this->name_first = $name_first;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameLast()
    {
        return $this->name_last;
    }

    /**
     * @param mixed $name_last
     * @return UserProfileModel
     */
    public function setNameLast($name_last)
    {
        $this->name_last = $name_last;
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
     * @return UserProfileModel
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
     * @return UserProfileModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     * @return UserProfileModel
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
        return $this;
    }

}
