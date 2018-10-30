<?php

declare(strict_types=1);

namespace Page\Form\Factory;

use Page\Form\PageWriteForm;
use Psr\Container\ContainerInterface;

class FactoryPageWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsTable = $container->get("SpaPetition\TableService");

        $petitions = $petitionsTable->fetchAll();

        foreach($petitions as $petition) {
            $formPetitions[$petition->getUid()] = $petition->getName();
        }

        return new PageWriteForm('form_create',[],$formPetitions);

    }
}
