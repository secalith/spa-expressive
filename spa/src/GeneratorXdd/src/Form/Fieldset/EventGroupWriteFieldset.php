<?php

declare(strict_types=1);

namespace Event\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Event\Model\WriteGroupFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class EventGroupWriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteGroupFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_event_group',
            'type' => \Event\Form\Fieldset\EventGroupFieldset::class,
            'options' => array(
                'label' => _("New Event Group"),
                'use_as_base_fieldset' => false
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}