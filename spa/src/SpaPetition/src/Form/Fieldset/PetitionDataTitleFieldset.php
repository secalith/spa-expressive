<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionDataTitleFieldset extends Fieldset implements InputFilterProviderInterface
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

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'language_holder',
            'attributes' => [
                'disabled' => 'disabled',
                'class' => 'disabled',
                'value' => 'Polski',
            ],
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'language',
            'attributes' => [
                'value' => 'pl_pl',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'title',
            'options' => [
                'label' => 'Tytul',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            ),
            'uid' => array(
                'required' => false,
            ),
        );
    }

}