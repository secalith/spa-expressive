<?php

declare(strict_types=1);

namespace Page;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'page' => [__DIR__ . '/../templates/page'],
            ],
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                "Page\\Table" => \Page\Service\Factory\PageTableServiceFactory::class,
                "Page\\Gateway" => \Page\Service\Factory\PageTableGatewayFactory::class,
                "Page\\Service" => \Page\Service\Factory\PageServiceFactory::class,
                \Page\Action\PageAction::class => Action\PageFactory::class,
            ],
        ];
    }

}
