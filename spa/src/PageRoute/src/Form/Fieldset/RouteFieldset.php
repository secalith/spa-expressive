<?php

declare(strict_types=1);

namespace PageRoute\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use PageRoute\Model\RouteModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class RouteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new RouteModel());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'value' => 'route-' . time(),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'route_name',
            'options' => array(
                'label' => _("Nazwa")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => _("Page Status"),
                'value_options' => [
                    '0' => _("Wylaczona"),
                    '1' => _("Aktywna"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'comment',
            'options' => array(
                'label' => _("Comment")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'route_name' => array(
                'required' => true,
            ),
        );
    }

}