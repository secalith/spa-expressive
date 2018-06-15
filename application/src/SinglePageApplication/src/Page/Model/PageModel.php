<?php
namespace SinglePageApplication\Page\Model;

class PageModel
{
    public $uid;
    public $name;
    public $template;
    public $route;


    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     * @return PageModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
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
     * @return PageModel
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     * @return PageModel
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }



    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->template = (!empty($data['template'])) ? $data['template'] : null;
        $this->route = (!empty($data['route'])) ? $data['route'] : null;
    }
}