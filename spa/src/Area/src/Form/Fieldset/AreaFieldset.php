<?php

declare(strict_types=1);

namespace Area\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Area\Model\AreaModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class AreaFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('collection_area');

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new AreaModel());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'text',
            'name' => 'uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'template_uid',
            'options' => array(
                'label' => _("Szablon")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'machine_name',
            'options' => array(
                'label' => _("Nazwa *")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'scope',
            'options' => array(
                'label' => _("Scope"),
                'value_options' => [
                    'page' => _("Page"),
                    'global' => _("Global"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
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
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'scope' => array(
                'required' => true,
            ),
        );
    }

}