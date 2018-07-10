<?php

declare(strict_types=1);

namespace Auth\Model;

class RequestCredentialsModel
{
    public $email;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->email = ( array_key_exists('email',$data))
            ? $data['email']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['email'] = $this->email;

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

}