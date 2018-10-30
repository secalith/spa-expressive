<?php

declare(strict_types=1);

namespace RestableAdmin\Client\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use RestableAdmin\Client\Model\Model;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ClientSelectFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new Model());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'client_uid'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_name',
            'options' => array(
                'label' => 'Client Name'
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'client_name' => array(
                'required' => true,
            ),
        );
    }

}