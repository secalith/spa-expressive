<?php
namespace Authentication\Form\Entity;

class LoginBasicEntity
{

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $basic
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return ContentEmailTemplateBasicEntity
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $password
     * @return ContentEmailTemplateRevisionBasicEntity
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return array
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function populate($data)
    {
        if (array_key_exists('username', $data)) {
            $this->setUsername($data['username']);
        }
        if (array_key_exists('password', $data)) {
            $this->setPassword($data['password']);
        }
    }

    public function toArray()
    {
        $properties = null;
        if(null!==$this->getUsername()) {
            $properties['username'] = $this->getUsername();
        }
        if(null!==$this->getPassword()) {
            $properties['password'] = $this->getPassword();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}