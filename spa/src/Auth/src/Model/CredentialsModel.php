<?php

declare(strict_types=1);

namespace Auth\Model;

class CredentialsModel
{
    public $email;
    public $password;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->email = ( array_key_exists('email',$data))
            ? $data['email']
            : null;
        $this->password = ( array_key_exists('password',$data))
            ? $data['password']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['email'] = $this->email;
        $data['password'] = $this->password;

        return $data;
    }

    public function getArrayCopy()
    {
        return $this->toArray();
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
     * @return CredentialsModel
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
     * @return CredentialsModel
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}