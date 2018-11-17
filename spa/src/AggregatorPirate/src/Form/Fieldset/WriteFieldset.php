<?php

declare(strict_types=1);

namespace AggregatorPirate\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \AggregatorPirate\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class WriteFieldset extends Fieldset implements InputFilterProviderInterface
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
            'name' => 'fieldset_entry_item',
            'type' => \AggregatorPirate\Form\Fieldset\EntryItemFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

        $this->add(array(
            'name' => 'fieldset_yt_entry_item',
            'type' => \AggregatorPirate\Form\Fieldset\YtEntryItemFieldset::class,
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