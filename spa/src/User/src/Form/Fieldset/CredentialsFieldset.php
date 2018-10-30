<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use User\Model\UserCredentialsModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class CredentialsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new UserCredentialsModel());
        $this->setAttribute('class','element_credentials_settings_manual-collection');

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add(array(
            'type' => 'password',
            'name' => 'password',
            'options' => array(
                'label' => 'Password'
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'password',
            'name' => 'password_confirm',
            'options' => array(
                'label' => 'Confirm Password'
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'password' => array(
                'required' => true,
            ),
            'password_confirm' => array(
                'required' => true,
            ),
        );
    }

}