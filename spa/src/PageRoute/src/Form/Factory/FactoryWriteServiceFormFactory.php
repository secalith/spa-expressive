<?php

declare(strict_types=1);

namespace Site\Form\Factory;

use Site\Form\WriteForm;
use Psr\Container\ContainerInterface;

class FactoryWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $requestedTable = $container->get("Application\TableService");
//
        $requestedData = $requestedTable->fetchAll(['status'=>1]);

        $data =[];

        if($requestedData->count()) {
            foreach($requestedData as $group) {
                $data[$group->getUid()] = $group->getType() . " (" . $group->getUid() . ")";
            }
        }


        return new WriteForm('form_create',[],$data);

    }
}
