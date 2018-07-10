<?php

namespace Form;

use Common\ConfigProvider as CommonConfigProvider;
/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider extends CommonConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                "Form\\Gateway" => \Form\Service\Factory\FormTableGatewayFactory::class,
                "Form\\Table" => \Form\Service\Factory\FormTableServiceFactory::class,
                "Form\\Block\\Gateway" => \Form\Service\Factory\FormBlockTableGatewayFactory::class,
                "Form\\Block\\Table" => \Form\Service\Factory\FormBlockTableServiceFactory::class,
            ],
        ];
    }

}
