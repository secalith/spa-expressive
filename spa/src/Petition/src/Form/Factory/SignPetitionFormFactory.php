<?php

declare(strict_types=1);

namespace Petition\Form\Factory;

use Petition\Form\PetitionSignatureWriteForm;
use Petition\Form\PetitionTranslationWriteForm;
use Psr\Container\ContainerInterface;

class SignPetitionFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        // get list of petitions

        //
//
//        $currentRouteName = $container->get(\Common\Helper\CurrentRouteNameHelper::class)->getMatchedRouteName();
//
//        $hostname = ($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:php_uname('n');
//
//        /* @var \Instance\Model\InstanceModel $instance */
//        $instance = $container->get("Instance\\TableService")->fetchBy(['hostname'=>$hostname]);
//
//        /* @var \Page\Model\PageModel $page */
//        $page = $container->get("Page\\TableService")->fetchBy(
//            [
//                'name' => $currentRouteName,
//                'site_uid' => $instance->getSiteUid(),
//            ]
//        );
//
//        $currentLanguage = $container->get(\I18n\Service\I18n::class)->getCurrentLanguage();
//        $defaultLanguage = $container->get(\I18n\Service\I18n::class)->getDefaultLanguage();

        return new PetitionSignatureWriteForm();
        var_dump($page);

        die();

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

        return new PetitionTranslationWriteForm('form_create',[],$formGroups);

    }
}
