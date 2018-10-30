<?php
// src/App/Helper/I18nDelegatorFactory.php

namespace i18n\Helper;

use Zend\I18n\View\HelperConfig;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Interop\Container\ContainerInterface;

class I18nDelegatorFactory implements DelegatorFactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        array $options = null
    ) {
        $helpers = $callback();

//
        $config = new HelperConfig();
        $config->configureServiceManager($helpers);

        return $helpers;
    }
}