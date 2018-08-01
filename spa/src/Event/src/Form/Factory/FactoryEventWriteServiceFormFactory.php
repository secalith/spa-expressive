<?php

declare(strict_types=1);

namespace Event\Form\Factory;

use Event\Form\EventWriteForm;
use Psr\Container\ContainerInterface;

class FactoryEventWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsTable = $container->get("Event\Group\TableService");

        $groups = $petitionsTable->fetchAll();

        $formGroups =[];

        if($groups->count()) {
            foreach($groups as $group) {
                $formGroups[$group->getUid()] = $group->getName();
            }
        }

        return new EventWriteForm('form_create',[],$formGroups);

    }
}
