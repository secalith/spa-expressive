<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \User\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class RemoveFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_user',
            'type' => \User\Form\Fieldset\RemoveUserFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}