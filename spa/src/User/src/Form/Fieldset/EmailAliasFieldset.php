<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use User\Model\EmailAliasModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class EmailAliasFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new EmailAliasModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add(array(
            'type' => 'email',
            'name' => 'email',
            'options' => array(
                'label' => 'Secondary Email'
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'email' => array(
                'required' => false,
            ),
        );
    }

}