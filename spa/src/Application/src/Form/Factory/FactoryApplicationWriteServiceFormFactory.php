<?php

declare(strict_types=1);

namespace Application\Form\Factory;

use Application\Form\ApplicationWriteForm;
use Psr\Container\ContainerInterface;

class FactoryApplicationWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
//        $requestedTable = $container->get("Application\Type\TableService");
//
//        $groups = $requestedTable->fetchAll(['status'=>1]);

        $formGroups =[];

//        if($groups->count()) {
//            foreach($groups as $group) {
//                $formGroups[$group->getUid()] = $group->getName();
//            }
//        }


        return new ApplicationWriteForm('form_create',[],$formGroups);

    }
}
