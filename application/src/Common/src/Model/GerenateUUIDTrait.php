<?php

declare(strict_types=1);

namespace Common\Model;

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

trait GerenateUUIDTrait
{
    private function generateUUID()
    {
        #TODO: make as Adapter
        try {
            $uuid4 = Uuid::uuid4();

            return $uuid4->toString();
        } catch (UnsatisfiedDependencyException $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}