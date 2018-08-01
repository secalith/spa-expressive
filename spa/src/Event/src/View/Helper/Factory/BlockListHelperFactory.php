<?php

namespace Event\View\Helper\Factory;

use Event\View\Helper\BlockListHelper;
use Psr\Container\ContainerInterface;

class BlockListHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // get current language
        $defaultLocale = \Locale::getDefault();


        // get events from visitors country first


        // get the rest of events


        // get modules native db-gateway services
        $config = $container->get('config');
        $tableServicesConfig = $config['app']['table_service'];

        $module = "Event\\";

        $nativeTableServices = new \Common\Model\CommonCollection();

        // Load db-gateways which belongs to the Event namespace
        foreach($tableServicesConfig as $tableServiceConfig)
        {
            if(array_key_exists('identifier',$tableServiceConfig))
            {
                if ($module === substr($tableServiceConfig['identifier'], 0, strlen($module)))
                {
                    if($container->has($tableServiceConfig['identifier'])) {
                        $nativeTableServices->addItem($container->get($tableServiceConfig['identifier']),$tableServiceConfig['identifier']);
                    }
                }
            }
        }

        $i18nService = $container->get(\I18n\Service\I18n::class);



        return new BlockListHelper($nativeTableServices,$i18nService);
    }
}