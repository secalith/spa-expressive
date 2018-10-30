<?php

declare(strict_types=1);

namespace PageRoute\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \PageRoute\Model\RouteWriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class RouteWriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new RouteWriteFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_route',
            'type' => \PageRoute\Form\Fieldset\RouteFieldset::class,
            'options' => array(
                'label' => _("Application"),
                'use_as_base_fieldset' => false
            )
        ));
//        $this->add(array(
//            'name' => 'fieldset_event_details',
//            'type' => \Event\Form\Fieldset\EventDetailsFieldset::class,
//            'options' => array(
//                'label' => _("Event Details"),
//                'use_as_base_fieldset' => false
//            )
//        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}