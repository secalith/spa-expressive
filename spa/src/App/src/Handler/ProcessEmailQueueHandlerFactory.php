<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ProcessEmailQueueHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $emailQueue = $container->get("Petition\\EmailQueue\\TableService");
        $petitionRecipientsGroup = $container->get("Petition\\Recipients\\Group\\TableService");
        $recipientsGroups = $container->get("Petition\\RecipientsGroup\\TableService");
        $recipients = $container->get("Petition\\Recipients\\TableService");
        $recipientsGroupAssign = $container->get("Petition\\GroupAssign\\TableService");
        $petitionTranslate = $container->get("Petition\\Translation\\TableService");
        $petitionSignature = $container->get("Petition\\Translation\\TableService");

//        $recipients->fetchBy();

        return new ProcessEmailQueueHandler($router, $template, get_class($container), $emailQueue, $petitionRecipientsGroup, $recipientsGroups, $recipients, $recipientsGroupAssign, $petitionTranslate);
    }
}
