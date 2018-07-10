<?php

namespace Auth\Form;

use Auth\Model\LoginFormModel;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class LoginForm extends Form
{

    public function __construct()
    {

        parent::__construct();

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new LoginFormModel());

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'application_id',
        ], ['priority'=>10]);

        $this->add(array(
            'name' => 'form_login',
            'type' => \Auth\Form\Fieldset\LoginFieldset::class,
            'options' => array(
//                'use_as_base_fieldset' => true
            )
        ));

        $this->add(new Element\Csrf('security'));

        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Sign in ',
                'class' => 'btn btn-lg btn-primary btn-block',
            ),
        ));
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
        );
    }
}