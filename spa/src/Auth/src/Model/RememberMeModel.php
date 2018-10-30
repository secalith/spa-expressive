<?php

declare(strict_types=1);

namespace Auth\Model;

class RememberMeModel
{
    public $remember_me;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data = [])
    {
        $this->remember_me = ( array_key_exists('remember_me',$data))
            ? $data['remember_me']
            : null;
    }

    public function toArray()
    {
        $data = [];

        $data['remember_me'] = $this->remember_me;

        return $data;
    }

    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getRememberMe()
    {
        return $this->remember_me;
    }

    /**
     * @param mixed $remember_me
     * @return RememberMeModel
     */
    public function setRememberMe($remember_me)
    {
        $this->remember_me = $remember_me;
        return $this;
    }

}