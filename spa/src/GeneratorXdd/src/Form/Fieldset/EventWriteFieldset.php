<?php

declare(strict_types=1);

namespace Event\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Event\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class EventWriteFieldset extends Fieldset implements InputFilterProviderInterface
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
            'name' => 'fieldset_event',
            'type' => \Event\Form\Fieldset\EventFieldset::class,
            'options' => array(
                'label' => _("Event"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_event_details',
            'type' => \Event\Form\Fieldset\EventDetailsFieldset::class,
            'options' => array(
                'label' => _("Event Details"),
                'use_as_base_fieldset' => false
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}