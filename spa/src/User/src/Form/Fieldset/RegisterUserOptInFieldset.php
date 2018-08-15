<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use User\Model\UserOptIn;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class RegisterUserOptInFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new UserOptIn());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'newsletter',
            'options' => array(
                'label' => 'I’d like to hear about new features, tips and other news from Art13.eu.',
                'label_attributes' => array(
                    'class'  => 'form-check-label',
                    'for' => 'register-newsletter',
                ),
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
            ),
            'attributes' => [
                'class' => 'form-check-input d-inline-flex w-auto',
                'id' => 'register-newsletter',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'terms',
            'options' => array(
                'label' => 'I agree to the terms of service and privacy policy.',
                'label_attributes' => array(
                    'class'  => 'form-check-label',
                    'for' => 'register-terms',
                ),
                'use_hidden_element' => false,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => [
                'class' => 'form-check-input d-inline-flex w-auto',
                'id' => 'register-terms',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'newsletter' => array(
                'required' => false,
            ),
            'terms' => array(
                'required' => true,
            ),
        );
    }

}