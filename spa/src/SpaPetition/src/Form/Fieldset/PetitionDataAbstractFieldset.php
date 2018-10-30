<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionDataAbstractFieldset extends Fieldset implements InputFilterProviderInterface
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
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'abstract',
            'options' => [
                'label' => _("Opis"),
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'abstract' => array(
                'required' => false,
            ),
            'uid' => array(
                'required' => false,
            ),
        );
    }

}