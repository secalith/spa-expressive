<?php

declare(strict_types=1);

namespace Event\Form\Factory;

use Event\Form\EventUpdateForm;
use Psr\Container\ContainerInterface;

class FactoryEventUpdateServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsTable = $container->get("Event\Group\TableService");

        $groups = $petitionsTable->fetchAll(['status'=>1]);

        $formGroups =[];

        if($groups->count()) {
            foreach($groups as $group) {
                $formGroups[$group->getUid()] = $group->getName();
            }
        }
//        echo 8;
//var_dump($formGroups);die();

        return new EventUpdateForm('form_update',[],$formGroups);

    }
}
