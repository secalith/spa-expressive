<?php

declare(strict_types=1);

namespace PageView;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies()
    {
        return [
            'factories'  => [
                \PageView\Service\PageViewService::class => \PageView\Service\Factory\PageViewServiceFactory::class,
            ],
        ];
    }
    public function getTemplates()
    {
        return [
            'paths' => [
                'page-view' => [__DIR__ . '/../templates/page-view'],
            ],
        ];
    }


}
