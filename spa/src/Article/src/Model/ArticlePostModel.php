<?php

declare(strict_types=1);

namespace Article\Model;

class ArticlePostModel
{
    public $uid;
    public $application_uid;
    public $site_uid;

    public $title;
    public $title_global;
    public $abstract;
    public $lead;
    public $text;

    public $file;

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

        $this->title = ( array_key_exists('title',$data)) ? $data['title'] : null;
        $this->title_global = ( array_key_exists('title_global',$data)) ? $data['title_global'] : null;
        $this->abstract = ( array_key_exists('abstract',$data)) ? $data['abstract'] : null;
        $this->lead = ( array_key_exists('lead',$data)) ? $data['lead'] : null;
        $this->text = ( array_key_exists('text',$data)) ? $data['text'] : null;

        $this->file = ( array_key_exists('file',$data)) ? $data['file'] : null;

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

        $data['title'] = $this->title;
        $data['abstract'] = $this->abstract;
        $data['lead'] = $this->lead;
        $data['text'] = $this->text;

        $data['file'] = $this->file;

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
     * @return ArticlePostModel
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
     * @return ArticlePostModel
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
     * @return ArticlePostModel
     */
    public function setSiteUid($site_uid)
    {
        $this->site_uid = $site_uid;
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
     * @return ArticlePostModel
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitleGlobal()
    {
        return $this->title_global;
    }

    /**
     * @param mixed $title_global
     * @return ArticlePostModel
     */
    public function setTitleGlobal($title_global)
    {
        $this->title_global = $title_global;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param mixed $abstract
     * @return ArticlePostModel
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param mixed $lead
     * @return ArticlePostModel
     */
    public function setLead($lead)
    {
        $this->lead = $lead;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return ArticlePostModel
     */
    public function setText($text)
    {
        $this->text = $text;
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
     * @return ArticlePostModel
     */
    public function setFile($file)
    {
        $this->file = $file;
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
     * @return ArticlePostModel
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
     * @return ArticlePostModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}
