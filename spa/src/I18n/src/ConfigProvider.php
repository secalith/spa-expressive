<?php

declare(strict_types=1);

namespace I18n;

/**
 * The configuration provider for the Instance module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'app' => $this->getApplicationConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'factories' => [
                \I18n\Handler\I18n::class => \I18n\Handler\I18nFactory::class,
                \I18n\Service\I18n::class => \I18n\Service\I18nFactory::class,
//                \Zend\I18n\Translator\TranslatorInterface::class => \Zend\I18n\Translator\TranslatorServiceFactory::class,
            ],
            'delegators' => [
                \Zend\View\HelperPluginManager::class => [
                    \I18n\Helper\I18nDelegatorFactory::class,
                ],
                'Common\Handler\Create' => [
//                    \I18n\Delegator\I18nAwareDelegator::class,
                ],
                'Common\Handler\Read' => [
                    \I18n\Delegator\I18nAwareDelegator::class,
                ],
                'Common\Handler\Update' => [
                    \I18n\Delegator\I18nAwareDelegator::class,
                ],
                'Common\Handler\Delete' => [
                    \I18n\Delegator\I18nAwareDelegator::class,
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'instance'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getApplicationConfig()
    {
        return [
            'config_service' => [
                'i18n' => [
                    'default' => 'en_en',
                    'list' => [
                        'en_en' > 'English',
                        'fr_fr' > 'French',
                        'pl_pl' > 'Polish',
                    ],
                ],
            ],
        ];
    }
}
