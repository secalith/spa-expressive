<?php

namespace Authentication\Form;

use Zend\Form\Element;
use \Zend\Form\Form;

class LoginForm extends Form
{

    public function __construct($name='form_login')
    {

        parent::__construct($name);

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Email address',
                'label_attributes' => [
                    'for' => 'inputEmail',
                    'class' => 'sr-only',
                ],
            ),
            'attributes' => [
                'id' => 'inputEmail',
                'class' => 'form-control',
                'placeholder' => 'Email address',
                'autofocus' => 'autofocus',
            ],
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Password',
            'name' => 'password',
            'options' => [
                'label' => 'Password',
                'label_attributes' => [
                    'for' => 'inputPassword',
                    'class' => 'sr-only',
                ],
            ],
            'attributes' => [
                'id' => 'inputEmail',
                'class' => 'form-control',
                'placeholder' => 'Password',
            ],
        ]);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'redirect_url',
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'remember_me',
            'options' => [
                'label' => 'Remember me',
                'label_attributes' => [
                    'for' => 'inputRememberMe',
                ],
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ],
            'attributes' => [
                'id' => 'inputRememberMe',
            ],
        ]);

        $this->add(new Element\Csrf('security'));

        $this->add(array(
            'name' => 'submit',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
            ),
        ));

        // We could also define the input filter here, or
        // lazy-create it in the getInputFilter() method.
    }

    public function getInputFilterSpecification()
    {
        return array(
            'redirect_url' => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'Zend\Filter\StringTrim'),
                ),
            ),
            'remember_me' => array(
                'required' => true,
            ),
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
                    new \Zend\Validator\Email(),
                ),
            ),
        );
    }
}