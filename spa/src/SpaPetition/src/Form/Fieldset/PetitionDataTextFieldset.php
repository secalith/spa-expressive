<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionDataTextFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PetitionModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'language'
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'text',
            'options' => [
                'label' => 'Tekst Petycji',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'text' => array(
                'required' => true,
            ),
            'language' => array(
                'required' => false,
            ),
        );
    }

}