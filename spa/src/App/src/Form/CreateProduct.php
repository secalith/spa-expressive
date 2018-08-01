<?php

namespace App\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class CreateProduct extends Form
{
    public function __construct()
    {
        parent::__construct('create_product');

        $this
            ->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter())
        ;

        $this->add(array(
            'type' => 'App\Form\ProductFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send',
            ),
        ));
    }
}