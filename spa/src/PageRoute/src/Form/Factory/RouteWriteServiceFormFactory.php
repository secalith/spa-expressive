<?php

declare(strict_types=1);

namespace PageRoute\Form\Factory;

use PageRoute\Form\RouteWriteForm as WriteForm;
use Psr\Container\ContainerInterface;

class RouteWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        $data = [];

        return new WriteForm('form_create',[],$data);

    }
}
