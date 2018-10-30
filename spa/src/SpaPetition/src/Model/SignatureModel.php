<?php

declare(strict_types=1);

namespace SpaPetition\Model;


class SignatureModel
{

    const STATUS_NEW = 0;

    public $uid;
    public $petition_uid;
    public $name_first;
    public $name_last;
    public $contact_email;
    public $ip;
    public $created;
    public $status;

    /**
     * CartModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (! empty($data)) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Populates the Object with data from the provided Array
     *
     * @param array $data
     * @return CartModel
     */
    public function exchangeArray(array $data = [])
    {
        $this->uid = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->petition_uid = (!empty($data['petition_uid'])) ? $data['petition_uid'] : null;
        $this->name_first = (!empty($data['name_first'])) ? $data['name_first'] : null;
        $this->name_last = (!empty($data['name_last'])) ? $data['name_last'] : null;
        $this->contact_email = (!empty($data['contact_email'])) ? $data['contact_email'] : null;
        $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }
        if ($this->petition_uid !== null) {
            $data['petition_uid'] = $this->petition_uid;
        }
        if ($this->name_first !== null) {
            $data['name_first'] = $this->name_first;
        }
        if ($this->name_last !== null) {
            $data['name_last'] = $this->name_last;
        }
        if ($this->ip !== null) {
            $data['ip'] = $this->ip;
        }
        if ($this->created !== null) {
            $data['created'] = $this->created;
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

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
     * @return SignatureModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPetitionUid()
    {
        return $this->petition_uid;
    }

    /**
     * @param mixed $petition_uid
     * @return SignatureModel
     */
    public function setPetitionUid($petition_uid)
    {
        $this->petition_uid = $petition_uid;
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
     * @return SignatureModel
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
     * @return SignatureModel
     */
    public function setNameLast($name_last)
    {
        $this->name_last = $name_last;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * @param mixed $contact_email
     * @return SignatureModel
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return SignatureModel
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
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
     * @return SignatureModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
     * @return SignatureModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}
