<?php

declare(strict_types=1);

namespace Auth\Model;

class UserEntity
{
    /**
     * @var string
     */
    protected $uid;

    /**
     * @var string
     */
    protected $email;

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return UserEntity
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserEntity
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

}
