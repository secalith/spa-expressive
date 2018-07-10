<?php

declare(strict_types=1);

namespace Common\Handler;

interface ApplicationConfigAwareInterface
{
    public function setHandlerConfig($configData=[]) : ApplicationConfigAwareInterface;
    public function getHandlerConfig(string $index=null);
}
