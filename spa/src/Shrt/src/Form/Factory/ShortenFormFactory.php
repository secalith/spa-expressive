<?php

declare(strict_types=1);

namespace Shrt\Form\Factory;

use Page\Form\PageWriteForm;
use Psr\Container\ContainerInterface;

class ShortenFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsTable = $container->get("SpaPetition\TableService");

        $petitions = $petitionsTable->fetchAll();

        foreach($petitions as $petition) {
            $formPetitions[$petition->getUid()] = $petition->getName();
        }

//        var_dump($formPetitions);
//        die();

        return new PageWriteForm('form_create',[],$formPetitions);

    }
}
