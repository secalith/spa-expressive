<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/User for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Common\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\Stdlib\Hydrator;

use Zend\Session\Container;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;


class CommonController extends AbstractActionController
{
    protected $module_namespace;
    protected $moduleName;
    protected $submoduleName;
    protected $route_name;
    protected $route;
    protected $page;
    protected $template;
    protected $area;
    protected $block;
    protected $content;
    protected $settings;
    protected $form;
    protected $services;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    public function setModuleNamespace($moduleNamespace=null)
    {
        $this->module_namespace = $moduleNamespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getModuleNamespace()
    {
        return $this->module_namespace;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        return $this;
    }
    public function getModuleName() {
        return $this->moduleName;
    }

    public function setSubmoduleName($submoduleName)
    {
        $this->submoduleName = $submoduleName;
        return $this;
    }
    public function getSubmoduleName() {
        return $this->submoduleName;
    }

    public function setRouteName($routeName=null)
    {
        $this->route_name = $routeName;
        return $this;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function setRoute($route=null)
    {
        $this->route = $route;
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setPage($page=null)
    {
        $this->page = $page;
        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return CommonController
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return mixed
     */
    public function getAreaBy($value,$name="name")
    {
        if(null!==$this->getArea()&&null!==$name) {

            $a = $this->getArea();

            foreach($a as $aa) {
                if(property_exists($aa,$name)
                    && $aa->{$name}===$value) {
                    return $aa;
                }
            }

            if(isset($this->area[$value])) {
                return $this->area[$value];
            }
        }
        return null;
    }

    /**
     * @param mixed $area
     * @return CommonController
     */
    public function setArea($area)
    {
        $a=null;
        foreach($area as $aa) {
            $a[$aa->get("machine_name")] = $aa;
        }
        $this->area = $a;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @return mixed
     */
    public function getBlockBy($value,$name="uid")
    {
        if(null!==$this->getBlock()&&null!==$name) {

            $b = $this->getBlock();

            foreach($b as $bb) {
                if(property_exists($bb,$name)
                    && $bb->{$name}===$value) {
                    return $bb;
                }
            }

            if(isset($this->block[$value])) {
                return $this->block[$value];
            }
        }
        return null;
    }

    /**
     * @param mixed $block
     * @return CommonController
     */
    public function setBlock($block)
    {
        if(null!==$this->getArea()) {
            $this->getAreaBy($block->getArea(),'uid')->setBlock($block);
        }

        $this->block[$block->getUid()] = $block;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return CommonController
     */
    public function setContent($content)
    {
        if(null!==$this->getBlock()) {
            $this->getBlockBy($content->getBlock(),'uid')->setContent($content);
        }

        $this->content[$content->getUid()] = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return mixed
     */
    public function getSetting($name)
    {
        return $this->settings[$name];
    }

    /**
     * @param mixed $settings
     * @return CommonController
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
        return $this;
    }

    public function addForm($form)
    {
        $this->form[$form->getName()] = $form;
    }

    public function getForm($name=null)
    {
        if(null!==$name
            &&null!==$this->form
            &&isset($this->form[$name])
        ) {
            return $this->form[$name];
        }
        return $this->form;
    }


    /**
     * @param null $map
     * @return $this
     */
    public function setServices($services = null)
    {
        $this->services = $services;
        return $this;
    }
    /**
     * Get service by reference name.
     *
     * @param null $service_name
     * @return null
     */
    public function getService($service_name=null)
    {
        if( null!==$service_name
            &&is_array($this->services)
            &&isset($this->services[$service_name])) {
            return $this->services[$service_name];
        }
        return null;
    }

    public function addService($service,$service_name=null)
    {
        $this->services[$service_name] = $service;
    }
}
