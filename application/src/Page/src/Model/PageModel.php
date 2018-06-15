<?php

declare(strict_types=1);

namespace Page\Model;

class PageModel
{
    public $uid;
    public $application_uid;
    public $route_uid;
    public $template_uid;
    public $name;
    public $route_url;
    public $page_cache;

    public $status;

    public $created;
    public $updated;

    /**
     * PageModel constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid = ( array_key_exists('uid',$data)) ? $data['uid'] : null;
        $this->application_uid = ( array_key_exists('application_uid',$data)) ? $data['application_uid'] : null;
        $this->route_uid = ( array_key_exists('route_uid',$data)) ? $data['route_uid'] : null;
        $this->template_uid = ( array_key_exists('template_uid',$data)) ? $data['template_uid'] : null;
        $this->name = ( array_key_exists('name',$data)) ? $data['name'] : null;
        $this->route_url = ( array_key_exists('route_url',$data)) ? $data['route_url'] : null;
        $this->page_cache = ( array_key_exists('page_cache',$data)) ? $data['page_cache'] : null;

        $this->status = ( array_key_exists('status',$data)) ? $data['status'] : null;

        $this->created = ( array_key_exists('created',$data)) ? $data['created'] : null;
        $this->updated = ( array_key_exists('updated',$data)) ? $data['updated'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['application_uid'] = $this->application_uid;
        $data['route_uid'] = $this->route_uid;
        $data['template_uid'] = $this->template_uid;
        $data['name'] = $this->name;
        $data['route_url'] = $this->route_url;
        $data['page_cache'] = $this->page_cache;

        $data['status'] = $this->status;

        $data['created'] = $this->created;
        $data['updated'] = $this->updated;

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
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
    public function getApplicationUid()
    {
        return $this->application_uid;
    }

    /**
     * @param mixed $application_uid
     * @return PageModel
     */
    public function setApplicationUid($application_uid)
    {
        $this->application_uid = $application_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteUid()
    {
        return $this->route_uid;
    }

    /**
     * @param mixed $route_uid
     * @return PageModel
     */
    public function setRouteUid($route_uid)
    {
        $this->route_uid = $route_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateUid()
    {
        return $this->template_uid;
    }

    /**
     * @param mixed $template_uid
     * @return PageModel
     */
    public function setTemplateUid($template_uid)
    {
        $this->template_uid = $template_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PageModel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteUrl()
    {
        return $this->route_url;
    }

    /**
     * @param mixed $route_url
     * @return PageModel
     */
    public function setRouteUrl($route_url)
    {
        $this->route_url = $route_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageCache()
    {
        return $this->page_cache;
    }

    /**
     * @param mixed $page_cache
     * @return PageModel
     */
    public function setPageCache($page_cache)
    {
        $this->page_cache = $page_cache;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return PageModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return PageModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return PageModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
