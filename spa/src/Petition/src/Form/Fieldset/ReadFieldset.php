<?php

declare(strict_types=1);

namespace Petition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Petition\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ReadFieldset extends Fieldset implements InputFilterProviderInterface
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
            'name' => 'fieldset_petition',
            'type' => \Petition\Form\Fieldset\PetitionFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

        $this->add(array(
            'name' => 'fieldset_petition_translation',
            'type' => \Petition\Form\Fieldset\PetitionTranslationFieldset::class,
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