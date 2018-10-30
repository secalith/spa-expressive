<?php

namespace i18n\Model;

class I18nModel
{

    public $current_language;
    public $available_languages;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->current_language     = (!empty($data['current_language'])) ? $data['current_language'] : null;
        $this->available_languages = (!empty($data['available_languages'])) ? $data['available_languages'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['current_language'] = $this->current_language;
        $data['available_languages'] = $this->available_languages;

        return $data;
    }

    /**
     * @return mixed
     */
    public function getCurrentLanguage()
    {
        return $this->current_language;
    }

    /**
     * @param mixed $current_language
     * @return I18nModel
     */
    public function setCurrentLanguage($current_language)
    {
        $this->current_language = $current_language;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvailableLanguages()
    {
        return $this->available_languages;
    }

    /**
     * @param mixed $available_languages
     * @return I18nModel
     */
    public function setAvailableLanguages($available_languages)
    {
        $this->available_languages = $available_languages;
        return $this;
    }

}