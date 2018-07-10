<?php

declare(strict_types=1);

namespace Auth\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Model\RequestCredentialsModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class RequestCredentialsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new RequestCredentialsModel());

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
    }

    public function getInputFilterSpecification()
    {
        return array(
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