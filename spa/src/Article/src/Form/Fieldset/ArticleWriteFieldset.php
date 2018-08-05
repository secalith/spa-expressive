<?php

declare(strict_types=1);

namespace Article\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Article\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class ArticleWriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_article',
            'type' => \Article\Form\Fieldset\ArticleFieldset::class,
            'options' => array(
                'label' => _("Create Article"),
                'use_as_base_fieldset' => false
            )
        ));
//        $this->add(array(
//            'name' => 'fieldset_event_details',
//            'type' => \Article\Form\Fieldset\ArticleDetailsFieldset::class,
//            'options' => array(
//                'label' => _("Event Details"),
//                'use_as_base_fieldset' => false
//            )
//        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}