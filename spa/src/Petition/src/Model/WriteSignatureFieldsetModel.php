<?php

declare(strict_types=1);

namespace Petition\Model;

class WriteSignatureFieldsetModel
{
    public $name;
    public $email;
    public $petition_uid;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->name = (!empty($data['name'])) ?? null;
        $this->email = (!empty($data['email'])) ?? null;
        $this->petition_uid = (!empty($data['petition_uid'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['petition_uid'] = $this->petition_uid;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return WriteSignatureFieldsetModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return WriteSignatureFieldsetModel
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return WriteSignatureFieldsetModel
     */
    public function setPetitionUid($petition_uid)
    {
        $this->petition_uid = $petition_uid;
        return $this;
    }

}
