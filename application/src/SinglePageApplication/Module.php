<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SinglePageApplication;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ArrayUtils;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        $config = array();
        $configFiles = array(
            include __DIR__ . '/config/module.content.config.php',
            include __DIR__ . '/config/module.content.app.config.php',
            include __DIR__ . '/config/module.block.config.php',
            include __DIR__ . '/config/module.area.config.php',
            include __DIR__ . '/config/module.template.config.php',
            include __DIR__ . '/config/module.page.config.php',
            include __DIR__ . '/config/module.route.config.php',
            include __DIR__ . '/config/module.acl.config.php',
            include __DIR__ . '/config/module.config.php',
        );
        foreach ($configFiles as $file) {
            $config = ArrayUtils::merge($config, $file);
        }
        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'SinglePageApplication\Area' => __DIR__ . '/src/Area',
                    'SinglePageApplication\Block' => __DIR__ . '/src/Block',
                    'SinglePageApplication\Content' => __DIR__ . '/src/Content',
                    'SinglePageApplication\Page' => __DIR__ . '/src/Page',
                    'SinglePageApplication\Route' => __DIR__ . '/src/Route',
                    'SinglePageApplication\Template' => __DIR__ . '/src/Template',
                    'SinglePageApplication\Common' => __DIR__ . '/src/Common',
                ),
            ),
        );
    }
}
