<?php
namespace Authentication\Form\Entity;

class LoginEntity
{

    /**
     * @var ContentEmailTemplateBasicEntity
     */
    protected $login;

    /**
     * @var ContentEmailTemplateRevisionBasicEntity
     */
    protected $additional;

    /**
     * @param LoginBasicEntity $login
     * @return LoginEntity $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return LoginBasicEntity
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param array $additional
     * @return LoginEntity $this
     */
    public function setAdditional($additional)
    {
        $this->additional = $additional;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    public function populate($data)
    {
        if (array_key_exists('login', $data)) {
            $this->setLogin($data['login']);
        }
        if (array_key_exists('additional', $data)) {
            $this->setAdditional($data['additional']);
        }
    }

    public function toArray()
    {
        $properties = null;
        if(null!==$this->getLogin()) {
            $properties['login'] = $this->getLogin();
        }
        if(null!==$this->getAdditional()) {
            $properties['additional'] = $this->getAdditional();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}