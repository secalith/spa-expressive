<?php

namespace Common\Listener\Factory;

use Common\Listener\LoggingErrorListener;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class LoggingErrorListenerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback) : ErrorHandler
    {
        $listener = new LoggingErrorListener($container->get(LoggerInterface::class));
        $errorHandler = $callback();
        $errorHandler->attachListener($listener);
        return $errorHandler;
    }
}
