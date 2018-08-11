<?php

declare(strict_types=1);

namespace Article\Model;

class ArticleExternalModel
{
    public $uid;
    public $application_uid;
    public $site_uid;

    public $name;
    public $name_global;
    public $description;
    public $publisher;
    public $publisher_url;
    public $link;
    public $comm;
    public $language;
    public $file;
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
        $this->site_uid = ( array_key_exists('site_uid',$data)) ? $data['site_uid'] : null;

        $this->name = ( array_key_exists('name',$data)) ? $data['name'] : null;
        $this->name_global = ( array_key_exists('name_global',$data)) ? $data['name_global'] : null;
        $this->description = ( array_key_exists('description',$data)) ? $data['description'] : null;
        $this->publisher = ( array_key_exists('publisher',$data)) ? $data['publisher'] : null;
        $this->publisher_url = ( array_key_exists('publisher_url',$data)) ? $data['publisher_url'] : null;
        $this->link = ( array_key_exists('link',$data)) ? $data['link'] : null;
        $this->comm = ( array_key_exists('comm',$data)) ? $data['comm'] : null;
        $this->language = ( array_key_exists('language',$data)) ? $data['language'] : null;
        $this->file = ( array_key_exists('file',$data)) ? $data['file'] : null;
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
        $data['site_uid'] = $this->site_uid;

        $data['name'] = $this->name;
        $data['name_global'] = $this->name_global;
        $data['description'] = $this->description;
        $data['publisher'] = $this->publisher;
        $data['publisher_url'] = $this->publisher_url;
        $data['link'] = $this->link;
        $data['comm'] = $this->comm;
        $data['language'] = $this->language;
        $data['file'] = $this->file;
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
    public function getNameGlobal()
    {
        return $this->name_global;
    }

    /**
     * @param mixed $name_global
     * @return ArticleExternalModel
     */
    public function setNameGlobal($name_global)
    {
        $this->name_global = $name_global;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return ArticleExternalModel
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     * @return ArticleExternalModel
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublisherUrl()
    {
        return $this->publisher_url;
    }

    /**
     * @param mixed $publisher_url
     * @return ArticleExternalModel
     */
    public function setPublisherUrl($publisher_url)
    {
        $this->publisher_url = $publisher_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @return ArticleExternalModel
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @return ArticleExternalModel
     */
    public function setComm($comm)
    {
        $this->comm = $comm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     * @return ArticleExternalModel
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return ArticleExternalModel
     */
    public function setFile($file)
    {
        $this->file = $file;
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
