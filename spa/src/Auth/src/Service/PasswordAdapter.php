<?php

namespace Auth\Service;

use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\Password\PasswordInterface;

class PasswordAdapter
{
    protected $password;

    protected $adapter;

    public function __construct(PasswordInterface $passwordAdapter = null)
    {
        $this->adapter = ($passwordAdapter)?$passwordAdapter:new \Zend\Crypt\Password\Bcrypt();
    }

    public function verify($password, $hash)
    {
        return $this->adapter->verify($password,$hash);
    }

    public function create($password)
    {
        return $this->adapter->create($password);
    }
}