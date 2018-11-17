<?php

declare(strict_types=1);

namespace AggregatorPirate\Model;

class YtEntryItemModel
{
    public $uid;
    public $parent_uid;

    public $comm;
    public $yt_id;
    public $title;

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
        $this->parent_uid = ( array_key_exists('parent_uid',$data)) ? $data['parent_uid'] : null;

        $this->comm = ( array_key_exists('comm',$data)) ? $data['comm'] : null;
        $this->yt_id = ( array_key_exists('yt_id',$data)) ? $data['yt_id'] : null;
        $this->title = ( array_key_exists('title',$data)) ? $data['title'] : null;

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
        $data['parent_uid'] = $this->parent_uid;

        $data['comm'] = $this->comm;
        $data['yt_id'] = $this->yt_id;
        $data['title'] = $this->title;

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
     * @return YtEntryItemModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentUid()
    {
        return $this->parent_uid;
    }

    /**
     * @param mixed $parent_uid
     * @return YtEntryItemModel
     */
    public function setParentUid($parent_uid)
    {
        $this->parent_uid = $parent_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * @param mixed $comm
     * @return YtEntryItemModel
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYtId()
    {
        return $this->yt_id;
    }

    /**
     * @param mixed $yt_id
     * @return YtEntryItemModel
     */
    public function setYtId($yt_id)
    {
        $this->yt_id = $yt_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return YtEntryItemModel
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return YtEntryItemModel
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
     * @return YtEntryItemModel
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
     * @return YtEntryItemModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
    
}
