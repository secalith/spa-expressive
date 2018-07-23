<?php

declare(strict_types=1);

namespace PageLayout;

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
            'factories'  => [],
            'delegator'  => [],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'page-layout'    => [__DIR__ . '/../templates/page-layout'],
            ],
        ];
    }
}
