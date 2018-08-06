<?php

declare(strict_types=1);

namespace Article\Model;

class WriteFieldsetModel
{
    public $fieldset_article;
    public $fieldset_article_details;
    public $fieldset_article_external;
    public $fieldset_article_internal;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_article = (!empty($data['fieldset_article'])) ?? null;
        $this->fieldset_article_external = (!empty($data['fieldset_article_external'])) ?? null;
        $this->fieldset_article_internal = (!empty($data['fieldset_article_internal'])) ?? null;
   }

    public function toArray()
    {
        $data = [];

        $data['fieldset_article'] = $this->fieldset_article;
        $data['fieldset_article_external'] = $this->fieldset_article_external;
        $data['fieldset_article_internal'] = $this->fieldset_article_internal;
//        $data['fieldset_event_details'] = $this->fieldset_event_details;

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
    public function getFieldsetArticle()
    {
        return $this->fieldset_article;
    }

    /**
     * @param mixed $fieldset_article
     * @return WriteFieldsetModel
     */
    public function setFieldsetArticle($fieldset_article)
    {
        $this->fieldset_article = $fieldset_article;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetArticleDetails()
    {
        return $this->fieldset_article_details;
    }

    /**
     * @param mixed $fieldset_article_details
     * @return WriteFieldsetModel
     */
    public function setFieldsetArticleDetails($fieldset_article_details)
    {
        $this->fieldset_article_details = $fieldset_article_details;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetArticleExternal()
    {
        return $this->fieldset_article_external;
    }

    /**
     * @param mixed $fieldset_article_external
     * @return WriteFieldsetModel
     */
    public function setFieldsetArticleExternal($fieldset_article_external)
    {
        $this->fieldset_article_external = $fieldset_article_external;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldsetArticleInternal()
    {
        return $this->fieldset_article_internal;
    }

    /**
     * @param mixed $fieldset_article_internal
     * @return WriteFieldsetModel
     */
    public function setFieldsetArticleInternal($fieldset_article_internal)
    {
        $this->fieldset_article_internal = $fieldset_article_internal;
        return $this;
    }

}
