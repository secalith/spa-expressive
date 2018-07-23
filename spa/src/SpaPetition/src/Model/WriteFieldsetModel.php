<?php

declare(strict_types=1);

namespace SpaPetition\Model;

class WriteFieldsetModel
{
    public $uid;
    public $title;
    public $default_language;
    public $status;

    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->uid     = (!empty($data['uid'])) ? $data['uid'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->default_language = (!empty($data['default_language'])) ? $data['default_language'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;

    }

    public function toArray()
    {
        $data = [];

        $data['uid'] = $this->uid;
        $data['title'] = $this->title;
        $data['default_language'] = $this->default_language;
        $data['status'] = $this->status;

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
     * @return WriteFieldsetModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
     * @return WriteFieldsetModel
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultLanguage()
    {
        return $this->default_language;
    }

    /**
     * @param mixed $default_language
     * @return WriteFieldsetModel
     */
    public function setDefaultLanguage($default_language)
    {
        $this->default_language = $default_language;
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
     * @return WriteFieldsetModel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
