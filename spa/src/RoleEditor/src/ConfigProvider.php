<?php

declare(strict_types=1);

namespace RoleEditor;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'templates'    => $this->getTemplates(),
            'rbac' => [
                'roles' => [
                    'guest' => ['editor'],
                    'editor' => ['administrator'],
                    'administrator' => [],
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'role-editor'    => [__DIR__ . '/../templates/role-editor'],
            ],
        ];
    }

}
