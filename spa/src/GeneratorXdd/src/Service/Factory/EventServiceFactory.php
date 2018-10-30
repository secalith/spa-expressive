<?php

declare(strict_types=1);

namespace Event\Service\Factory;

use Event\Service\EventService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class EventServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
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
                        $nativeTableServices->addItem($container->has($tableServiceConfig['identifier']),$tableServiceConfig['identifier']);
                    }
                }
            }
        }

        return new EventService($nativeTableServices);
    }
}
