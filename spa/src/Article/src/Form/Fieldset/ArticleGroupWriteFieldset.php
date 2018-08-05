<?php

declare(strict_types=1);

namespace Article\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Article\Model\WriteGroupFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class ArticleGroupWriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new WriteGroupFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_article_group',
            'type' => \Article\Form\Fieldset\ArticleGroupFieldset::class,
            'options' => array(
                'label' => _("New Article Group"),
                'use_as_base_fieldset' => false
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}