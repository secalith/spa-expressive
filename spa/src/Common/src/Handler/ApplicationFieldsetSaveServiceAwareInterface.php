<?php

declare(strict_types=1);

namespace Common\Handler;

interface ApplicationFieldsetSaveServiceAwareInterface
{
    public function setFieldsetService($form=null,string $index=null) : ApplicationFieldsetSaveServiceAwareInterface;
    public function getFieldsetService(string $index=null);
    public function getFieldsetServiceAll() : array;
    public function hasFieldsetService(string $key) : bool;
}
