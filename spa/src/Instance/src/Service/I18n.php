<?php
namespace I18n\Service;

use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class I18n
{
    private $translator;
    private $currentLanguage;
    private $defaultLanguage;

    /**
     * Constructs the service.
     */
    public function __construct($translator,$currentLanguage,$defaultLanguage)
    {

        $this->translator = $translator;
        $this->currentLanguage = $currentLanguage;
        $this->defaultLanguage = $defaultLanguage;
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param mixed $translator
     * @return I18n
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentLanguage()
    {
        return $this->currentLanguage;
    }

    /**
     * @param mixed $curentLanguage
     * @return I18n
     */
    public function setCurrentLanguage($curentLanguage)
    {
        $this->currentLanguage = $curentLanguage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }

    /**
     * @param mixed $defaultLanguage
     * @return I18n
     */
    public function setDefaultLanguage($defaultLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
        return $this;
    }

}

