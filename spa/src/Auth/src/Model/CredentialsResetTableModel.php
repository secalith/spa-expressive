<?php

declare(strict_types=1);

namespace Auth\Model;

class CredentialsResetTableModel
{
    public $uid;
    public $email;
    public $token;
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
        $this->token = ( array_key_exists('token',$data))
            ? $data['token']
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
        $data['token'] = $this->token;
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     * @return CredentialsResetTableModel
     */
    public function setToken($token)
    {
        $this->token = $token;
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