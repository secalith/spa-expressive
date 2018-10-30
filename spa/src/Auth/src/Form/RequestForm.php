<?php

namespace Auth\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class RequestForm extends Form
{

    public function __construct()
    {

        parent::__construct();

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new \Auth\Model\RequestFormModel());

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'application_id',
        ], ['priority'=>10]);

        $this->add(array(
            'name' => 'form_request',
            'type' => \Auth\Form\Fieldset\RequestFieldset::class,
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