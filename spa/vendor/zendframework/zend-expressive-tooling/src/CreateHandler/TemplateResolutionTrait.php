<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-tooling for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-tooling/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Zend\Expressive\Tooling\CreateHandler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

use function preg_replace;
use function strtolower;
use function strpos;
use function strrpos;
use function substr;

trait TemplateResolutionTrait
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Normalizes identifier to lowercase, dash-separated words.
     */
    private function normalizeTemplateIdentifier(string $identifier) : string
    {
        $pattern     = ['#(?<=(?:\p{Lu}))(\p{Lu}\p{Ll})#', '#(?<=(?:\p{Ll}|\p{Nd}))(\p{Lu})#'];
        $replacement = ['-\1', '-\1'];
        $identifier  = preg_replace($pattern, $replacement, $identifier);
        return strtolower($identifier);
    }

    /**
     * Returns the top-level namespace for the given class.
     */
    private function getNamespace(string $class) : string
    {
        return substr($class, 0, strpos($class, '\\'));
    }

    /**
     * Retrieves the namespace for the class using getNamespace, passes
     * the result to normalizeTemplateIdentifier(), and returns the result.
     */
    private function getTemplateNamespaceFromClass(string $class) : string
    {
        return $this->normalizeTemplateIdentifier($this->getNamespace($class));
    }

    /**
     * Returns the unqualified class name (class minus namespace).
     */
    private function getClassName(string $class) : string
    {
        return substr($class, strrpos($class, '\\') + 1);
    }

    /**
     * Passes the $class to getClassName(), strips any "Action" or "Handler"
     * or "Middleware" suffixes, passes it to normalizeTemplateIdentifier(),
     * and returns the result.
     */
    private function getTemplateNameFromClass(string $class) : string
    {
        return $this->normalizeTemplateIdentifier(
            preg_replace(
                '#(Action|Handler|Middleware)$#',
                '',
                $this->getClassName($class)
            )
        );
    }

    private function getContainer(string $projectPath) : ContainerInterface
    {
        if ($this->container) {
            return $this->container;
        }

        $containerPath = sprintf('%s/config/container.php', $projectPath);
        $this->container = require $containerPath;
        return $this->container;
    }

    /**
     * Retrieve project configuration.
     */
    private function getConfig(string $projectPath) : array
    {
        return $this->getContainer($projectPath)->get('config');
    }

    /**
     * Returns true if a renderer service is found in the container.
     */
    private function containerDefinesRendererService(ContainerInterface $container) : bool
    {
        // Casting to bool so that test prophecies work without needing to define
        // explicit expectations in every situation.
        return (bool) $container->has(TemplateRendererInterface::class);
    }

    private function getRendererServiceTypeFromContainer(ContainerInterface $container) : ?string
    {
        if (! $container->has(TemplateRendererInterface::class)) {
            return null;
        }
        $renderer = $container->get(TemplateRendererInterface::class);
        return get_class($renderer);
    }
}
