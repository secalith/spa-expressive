<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class WriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'name' => 'fieldset_petition',
            'type' => PetitionDataFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

//        $this->add(array(
//            'type' => 'Zend\Form\Element\Collection',
//            'name' => 'petition',
//            'options' => array(
//                'label' => _("Petycja"),
//                'count' => 1,
//                'should_create_template' => true,
//                'template_placeholder' => '__placeholder__',
//                'target_element' => array(
//                    'type' => 'SpaPetition\Form\Fieldset\PetitionFieldset'
//                )
//            )
//        ));

    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}