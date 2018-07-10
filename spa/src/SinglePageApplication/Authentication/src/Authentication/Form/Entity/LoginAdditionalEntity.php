<?php
namespace Authentication\Form\Entity;

class LoginAdditionalEntity
{

    /**
     * @var string
     */
    protected $keep_logged_in;

    /**
     * @param ContentEmailTemplateBasicEntity $basic
     * @return $this
     */
    public function setKeepLoggedIn($keep_logged_in)
    {
        $this->keep_logged_in = $keep_logged_in;
        return $this;
    }

    /**
     * @return ContentEmailTemplateBasicEntity
     */
    public function getKeepLoggedIn()
    {
        return $this->keep_logged_in;
    }

    public function populate($data)
    {
        if (array_key_exists('keep_logged_in', $data)) {
            $this->setKeepLoggedIn($data['keep_logged_in']);
        }
    }

    public function toArray()
    {
        $properties = null;
        if(null!==$this->getKeepLoggedIn()) {
            $properties['keep_logged_in'] = $this->getKeepLoggedIn();
        }
        return $properties;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}