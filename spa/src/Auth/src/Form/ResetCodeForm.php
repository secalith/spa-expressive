<?php

namespace Auth\Form;

use Auth\Model\LoginFormModel;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class ResetCodeForm extends Form
{

    public function __construct()
    {

        parent::__construct();

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new \Auth\Model\ResetCodeFormModel());

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'application_id',
        ], ['priority'=>10]);

        $this->add(array(
            'name' => 'form_reset_code',
            'type' => \Auth\Form\Fieldset\ResetCodeFieldset::class,
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
        return array();
    }
}