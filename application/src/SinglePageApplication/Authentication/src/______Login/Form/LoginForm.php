<?php
namespace Authentication\Form\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class LoginForm extends Form
{
    
    public function __construct($name='authentication', $options = [])
    {
        parent::__construct($name,$options);
        $h = new ClassMethodsHydrator(true);
    //->setUnderscoreSeparatedKeys(true)
        $this->setAttribute('class', 'form-horizontal')
            ->setHydrator($h)
            ->setInputFilter(new InputFilter());
        $this->setAttribute('method', 'post');

        $this->add([
             'type' => 'Zend\Form\Element\Csrf',
             'name' => 'csrf',
         ]);

        $this->add(array(
            'type' => 'Authentication\Form\Fieldset\LoginFoundationFieldset',
            'name' => 'authentication',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->add(
            [
                'name' => 'submit',
                'type' => 'submit',
                'attributes' => [
                    'value' => 'Login',
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                ],
            ],
            array('priority'=>-1000)
        );
        
        $this->setValidationGroup([
            'csrf',
            'authentication',
        ]);
    }
}