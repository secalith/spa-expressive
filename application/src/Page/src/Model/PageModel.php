<?php

declare(strict_types=1);

namespace Page\Model;

class PageModel
{
    public $uid;
    public $route_uid;
    public $template_uid;
    public $name;
    public $route_url;
    public $page_cache;

    public $status;

    public $created;
    public $updated;

    /**
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->route_uid = (!empty($data['route_uid'])) ? $data['route_uid'] : null;
        $this->template_uid = (!empty($data['template_uid'])) ? $data['template_uid'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->route_url = (!empty($data['route_url'])) ? $data['route_url']:null;
        $this->page_cache = (!empty($data['page_cache'])) ? $data['page_cache']:null;

        $this->status = (!empty($data['status'])) ? $data['status']:null;

        $this->created = (!empty($data['created'])) ? $data['created']:null;
        $this->updated = (!empty($data['updated'])) ? $data['updated']:null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        if ($this->uid !== null) {
            $data['uid'] = $this->uid;
        }
        if ($this->route_uid !== null) {
            $data['route_uid'] = $this->route_uid;
        }
        if ($this->template_uid !== null) {
            $data['template_uid'] = $this->template_uid;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->route_url !== null) {
            $data['route_url'] = $this->route_url;
        }
        if ($this->page_cache !== null) {
            $data['page_cache'] = $this->page_cache;
        }

        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

        if ($this->created !== null) {
            $data['created'] = $this->created;
        }
        if ($this->updated !== null) {
            $data['updated'] = $this->updated;
        }

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
