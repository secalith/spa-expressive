<?php

declare(strict_types=1);

namespace Common\Handler;

trait ApplicationConfigAwareTrait
{
    protected $configData = [];

    public function setHandlerConfig($configData = []) : ApplicationConfigAwareInterface
    {
        $this->configData = $configData;

        return $this;
    }

    /**
     * @param string|null $index
     * @return array|string|null
     */
    public function getHandlerConfig( string $index=null)
    {
        if($index !== null) {
            if(array_key_exists($index,$this->configData)) {
                return $this->configData[$index];
            }
        }

        return $this->configData;
    }
}
