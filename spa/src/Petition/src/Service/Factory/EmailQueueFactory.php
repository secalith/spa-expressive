<?php

declare(strict_types=1);

namespace Petition\Service\Factory;

use Petition\Service\EmailQueueService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class EmailQueueFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $emailQueue = $container->get("Petition\\EmailQueue\\TableService");
        $petitionTranslation = $container->get("Petition\\Translation\\TableService");
        $petitionRecipientsGroup = $container->get("Petition\\Recipients\\Group\\TableService");

        $currentLanguage = $container->get(\I18n\Service\I18n::class)->getCurrentLanguage();
//var_dump($currentLanguage);




        return new EmailQueueService($emailQueue, $petitionTranslation, $petitionRecipientsGroup, $currentLanguage);
    }
}
