<?php

declare(strict_types=1);

namespace AggregatorPirate\Form\Factory;

use AggregatorPirate\Form\EntryItemWriteForm;
use Psr\Container\ContainerInterface;

class FactoryEntryItemWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
//        $petitionsTable = $container->get("Event\Group\TableService");
//
//        $groups = $petitionsTable->fetchAll(['status'=>1]);

        $formGroups =[];

//        if($groups->count()) {
//            foreach($groups as $group) {
//                $formGroups[$group->getUid()] = $group->getName();
//            }
//        }


        return new EntryItemWriteForm('form_create',[],$formGroups);

    }
}
