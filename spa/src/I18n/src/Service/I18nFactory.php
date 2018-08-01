<?php

namespace I18n\Service;

use Interop\Container\ContainerInterface;

/**
 * This is the factory class for UserManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class I18nFactory
{
    /**
     * This method creates the UserManager service and returns its instance.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $config = $container->get('config');

        $translator = $container->get(\Zend\I18n\Translator\TranslatorInterface::class);

        $currentLanguage = $this->getUserLanguage();

        $defaultLanguage = $config['app']['service']['i18n']['config']['parameters']['default'];

        $availableLanguages = $config['app']['service']['i18n']['config']['options']['languages'];

        if( ! isset($availableLanguages[$currentLanguage])) {
            $currentLanguage = $defaultLanguage;
        }

        return new I18n($translator,$currentLanguage);
    }

    function getUserLanguage() {
        $langs = array();

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            // break up string into pieces (languages and q factors)
            preg_match_all(
                '/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i',
                $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                $lang_parse
            );

            if (count($lang_parse[1])) {
                // create a list like 'en' => 0.8
                $langs = array_combine($lang_parse[1], $lang_parse[4]);

                // set default to 1 for any without q factor
                foreach ($langs as $lang => $val) {
                    if ($val === '') {
                        $langs[$lang] = 1;
                    }
                }
                // sort list based on value
                arsort($langs, SORT_NUMERIC);
            }
        }
        //extract most important (first)
        reset($langs);
        $lang = key($langs);

        //if complex language simplify it
        if (stristr($lang, '-')) {
            list($lang) = explode('-', $lang);
        }

        return $lang . "_" . $lang;
    }
}
