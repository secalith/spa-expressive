<?php

declare(strict_types=1);

namespace Article\Form\Factory;

use Article\Form\ArticleWriteForm;
use Psr\Container\ContainerInterface;

class FactoryArticleWriteServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions
        $petitionsTable = $container->get("Article\Group\TableService");

        $groups = $petitionsTable->fetchAll(['status'=>1]);

        $formGroups =[];

        if($groups->count()) {
            foreach($groups as $group) {
                $formGroups[$group->getUid()] = $group->getName();
            }
        }


        return new ArticleWriteForm('form_create',[],$formGroups);

    }
}
