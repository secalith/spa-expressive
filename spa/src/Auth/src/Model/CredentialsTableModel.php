<?php

declare(strict_types=1);

namespace Auth\Model;

class CredentialsTableModel
{
    public $uid;
    public $email;
    public $password;
    public $status;
    public $created;
    public $updated;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->uid = ( array_key_exists('uid',$data))
            ? $data['uid']
            : null;
        $this->email = ( array_key_exists('email',$data))
            ? $data['email']
            : null;
        $this->password = ( array_key_exists('password',$data))
            ? $data['password']
            : null;
        $this->status = ( array_key_exists('status',$data))
            ? $data['status']
            : null;
        $this->created = ( array_key_exists('created',$data))
            ? $data['created']
            : null;
        $this->updated = ( array_key_exists('updated',$data))
            ? $data['updated']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['email'] = $this->email;
        $data['password'] = $this->password;
        $data['status'] = $this->status;
        $data['created'] = $this->created;
        $data['updated'] = $this->updated;

        return $data;
    }

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
     * @return CredentialsTableModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
     * @return CredentialsTableModel
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return CredentialsTableModel
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     * @return CredentialsTableModel
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
     * @return CredentialsTableModel
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
     * @return CredentialsTableModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}