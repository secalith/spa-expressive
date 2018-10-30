<?php

declare(strict_types=1);

namespace Petition\Form\Factory;

use Petition\Form\PetitionUpdateForm;
use Psr\Container\ContainerInterface;

class FactoryPetitionUpdateServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsGroupsTable = $container->get("Petition\TableService");

        $groups = $petitionsGroupsTable->fetchAllBy();

        $formGroups =[];

        if($groups->count()) {
            foreach($groups as $group) {
                if( 0 !== $group->getStatus()) {
                    $formGroups[$group->getUid()] = $group->getName();
                } else {
                    $formGroups[$group->getUid()] = sprintf("%s (*)",$group->getName());
                }
            }
        }

        return new PetitionUpdateForm('form_update',[],$formGroups);

    }
}
