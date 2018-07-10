<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Common;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ArrayUtils;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        $config = array();
        $configFiles = array(
            include __DIR__ . '/config/module.data_selector.config.php',
            include __DIR__ . '/config/module.data_selector.app.config.php',
            include __DIR__ . '/config/module.data_map.config.php',
            include __DIR__ . '/config/module.data_map.map.config.php',
            include __DIR__ . '/config/module.settings.config.php',
            include __DIR__ . '/config/module.database.config.php',
            include __DIR__ . '/config/module.route.config.php',
            include __DIR__ . '/config/module.config.php', // <-- make sure this one is last
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
                    "Common" => __DIR__ . '/src/Common',
                    'Common\Route' => __DIR__ . '/src/Route',
                    'Common\Page' => __DIR__ . '/src/Page',
                    'Common\Template' => __DIR__ . '/src/Template',
                    'Common\Area' => __DIR__ . '/src/Area',
                    'Common\Block' => __DIR__ . '/src/Block',
                    'Common\Content' => __DIR__ . '/src/Content',
                    'Common\Settings' => __DIR__ . '/src/Settings',
                    'Common\Form' => __DIR__ . '/src/Form',
                    'Common\FormData' => __DIR__ . '/src/FormData',
                    'Common\DataSelector' => __DIR__ . '/src/DataSelector',
                    'Common\DataMap' => __DIR__ . '/src/DataMap',
                ),
            ),
        );
    }
}
