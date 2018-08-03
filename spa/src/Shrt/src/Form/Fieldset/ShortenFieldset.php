<?php

declare(strict_types=1);

namespace Shrt\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Page\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class ShortenFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_shorten',
            'type' => \Shrt\Form\Fieldset\LinkFieldset::class,
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