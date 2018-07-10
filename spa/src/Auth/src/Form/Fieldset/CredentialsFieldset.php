<?php

declare(strict_types=1);

namespace Auth\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Model\CredentialsModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class CredentialsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new CredentialsModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add([
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => [
                'label' => 'Email address',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Email'
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Password',
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Password'
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'password' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
            ),
            'email' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
                'validators' => array(
                    new \Zend\Validator\EmailAddress(),
                ),
            ),
        );
    }

}