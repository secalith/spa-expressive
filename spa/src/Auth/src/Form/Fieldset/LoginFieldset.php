<?php

declare(strict_types=1);

namespace Auth\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Model\LoginModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class LoginFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new LoginModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'name' => 'fieldset_credentials',
            'type' => \Auth\Form\Fieldset\CredentialsFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

        $this->add(array(
            'name' => 'fieldset_rememberme',
            'type' => \Auth\Form\Fieldset\RememberMeFieldset::class,
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
//            'client_name' => array(
//                'required' => true,
//            ),
        );
    }

}