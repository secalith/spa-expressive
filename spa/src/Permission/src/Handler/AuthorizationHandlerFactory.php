<?php

declare(strict_types=1);

namespace Permission\Handler;

use	Exception;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Permissions\Rbac\Rbac;
use Zend\Permissions\Rbac\Role;

class AuthorizationHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AuthorizationHandler
    {
        $config = $container->get('config');
        if (! isset($config['rbac']['roles'])) {
            throw new Exception('Rbac roles are not configured');
        }
        if (!isset($config['rbac']['permissions'])) {
            throw new Exception('Rbac permissions are not configured');
        }

        $rbac = new Rbac();
        $rbac->setCreateMissingRoles(true);
        // roles and parents
        foreach ($config['rbac']['roles'] as $role => $parents) {
            $rbac->addRole($role, $parents);
        }
        // permissions
        foreach ($config['rbac']['permissions'] as $role => $permissions) {
            foreach ($permissions as $perm) {
                $rbac->getRole($role)->addPermission($perm);
            }
        }

        return new AuthorizationHandler($container->get(TemplateRendererInterface::class));
    }
}
