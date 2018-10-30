<?php

declare(strict_types=1);

namespace Article\Model;

class WriteGroupFieldsetModel
{
    public $fieldset_article_group;


    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray($data)
    {
        $this->fieldset_article_group = (!empty($data['fieldset_article_group'])) ?? null;
    }

    public function toArray()
    {
        $data = [];

        $data['fieldset_article_group'] = $this->fieldset_article_group;

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
    public function getFieldsetArticleGroup()
    {
        return $this->fieldset_article_group;
    }

    /**
     * @param mixed $fieldset_article_group
     * @return WriteGroupFieldsetModel
     */
    public function setFieldsetArticleGroup($fieldset_article_group)
    {
        $this->fieldset_article_group = $fieldset_article_group;
        return $this;
    }

}
