<?php

declare(strict_types=1);

namespace Auth\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Model\RememberMeModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class RememberMeFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new RememberMeModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'remember_me',
            'options' => array(
                'label' => 'Remember me',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => [
                'id'=>'login-remember_me',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'remember_me' => [
                'required' => true,
            ],
        );
    }

}