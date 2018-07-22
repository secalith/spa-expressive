<?php


namespace ArticleExternal\Model;

class ArticleExternalModel
{
    public $uid;
    public $application_uid;
    public $site_uid;
    public $route_uid;
    public $template_uid;
    public $name;
    public $route_url;
    public $page_cache;
    public $status;
    public $created;
    public $updated;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->application_uid = (!empty($data['application_uid'])) ? $data['application_uid'] : null;
        $this->site_uid = (!empty($data['site_uid'])) ? $data['site_uid'] : null;
        $this->route_uid = (!empty($data['route_uid'])) ? $data['route_uid'] : null;
        $this->template_uid = (!empty($data['template_uid'])) ? $data['template_uid'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->route_url = (!empty($data['route_url'])) ? $data['route_url'] : null;
        $this->page_cache = (!empty($data['page_cache'])) ? $data['page_cache'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['application_uid'] = $this->application_uid;
        $data['site_uid'] = $this->site_uid;
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
     */
    public function setApplicationUid($application_uid)
    {
        $this->application_uid = $application_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSiteUid()
    {
        return $this->site_uid;
    }

    /**
     * @param mixed $site_uid
     * @return ArticleExternalModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
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
     * @return ArticleExternalModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
