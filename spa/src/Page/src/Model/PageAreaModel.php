<?php

declare(strict_types=1);

namespace Page\Model;

class PageAreaModel
{
    public $uid;
    public $page_type_event;
    public $page_type_petition;
    public $page_type_links;

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
        $this->page_type_event = ( array_key_exists('page_type_event',$data)) ? $data['page_type_event'] : null;
        $this->page_type_petition = ( array_key_exists('page_type_petition',$data)) ? $data['page_type_petition'] : null;
        $this->page_type_links = ( array_key_exists('page_type_links',$data)) ? $data['page_type_links'] : null;

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
        $data['page_type_event'] = $this->page_type_event;
        $data['page_type_petition'] = $this->page_type_petition;
        $data['page_type_links'] = $this->page_type_links;

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
     * @return PageAreaModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageTypeEvent()
    {
        return $this->page_type_event;
    }

    /**
     * @param mixed $page_type_event
     * @return PageAreaModel
     */
    public function setPageTypeEvent($page_type_event)
    {
        $this->page_type_event = $page_type_event;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageTypePetition()
    {
        return $this->page_type_petition;
    }

    /**
     * @param mixed $page_type_petition
     * @return PageAreaModel
     */
    public function setPageTypePetition($page_type_petition)
    {
        $this->page_type_petition = $page_type_petition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageTypeLinks()
    {
        return $this->page_type_links;
    }

    /**
     * @param mixed $page_type_links
     * @return PageAreaModel
     */
    public function setPageTypeLinks($page_type_links)
    {
        $this->page_type_links = $page_type_links;
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
     * @return PageAreaModel
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
     * @return PageAreaModel
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
     * @return PageAreaModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
