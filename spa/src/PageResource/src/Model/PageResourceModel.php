<?php


namespace PageResource\Model;

class PageResourceModel
{
    public $uid;
    public $page_uid;
    public $site_uid;
    public $resource_uid;
    public $resource_name;
    public $resource_type;
    public $resource_cache;
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
        $this->page_uid = (!empty($data['page_uid'])) ? $data['page_uid'] : null;
        $this->site_uid = (!empty($data['site_uid'])) ? $data['site_uid'] : null;
        $this->resource_uid = (!empty($data['resource_uid'])) ? $data['resource_uid'] : null;
        $this->resource_name = (!empty($data['resource_name'])) ? $data['resource_name'] : null;
        $this->resource_type = (!empty($data['resource_type'])) ? $data['resource_type'] : null;
        $this->resource_cache = (!empty($data['resource_cache'])) ? $data['resource_cache'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['page_uid'] = $this->page_uid;
        $data['site_uid'] = $this->site_uid;
        $data['resource_uid'] = $this->resource_uid;
        $data['resource_name'] = $this->resource_name;
        $data['resource_type'] = $this->resource_type;
        $data['resource_cache'] = $this->resource_cache;
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
     * @return PageResourceModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageUid()
    {
        return $this->page_uid;
    }

    /**
     * @param mixed $page_uid
     * @return PageResourceModel
     */
    public function setPageUid($page_uid)
    {
        $this->page_uid = $page_uid;
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
     * @return PageResourceModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResourceUid()
    {
        return $this->resource_uid;
    }

    /**
     * @param mixed $resource_uid
     * @return PageResourceModel
     */
    public function setResourceUid($resource_uid)
    {
        $this->resource_uid = $resource_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResourceName()
    {
        return $this->resource_name;
    }

    /**
     * @param mixed $resource_name
     * @return PageResourceModel
     */
    public function setResourceName($resource_name)
    {
        $this->resource_name = $resource_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResourceType()
    {
        return $this->resource_type;
    }

    /**
     * @param mixed $resource_type
     * @return PageResourceModel
     */
    public function setResourceType($resource_type)
    {
        $this->resource_type = $resource_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResourceCache()
    {
        return $this->resource_cache;
    }

    /**
     * @param mixed $resource_cache
     * @return PageResourceModel
     */
    public function setResourceCache($resource_cache)
    {
        $this->resource_cache = $resource_cache;
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
     * @return PageResourceModel
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
     * @return PageResourceModel
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
     * @return PageResourceModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
