<?php

declare(strict_types=1);

namespace PageView;

class ConfigProvider
{

    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies()
    {
        return [
            'delegators' => [
                \Page\Action\PageAction::class => [
                    \PageView\Controller\Delegator\PageViewDelegatorFactory::class,
                ],
            ],
        ];
    }

}
