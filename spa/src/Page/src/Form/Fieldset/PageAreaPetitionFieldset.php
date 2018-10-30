<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Page\Model\PageModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageAreaPetitionFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PageModel());
        $this->setAttribute('class','page_type_petition-collection');

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'page_layout',
            'options' => array(
                'label' => _("Page Layout"),
                'value_options' => [
                    'petition' => _("Petition"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
        $this->add(array(
            'name' => 'page_type_petition_areas',
            'type' => \Page\Form\Fieldset\PageAreaPetitionAreasFieldset::class,
            'options' => array(
                'label' => _("Area"),
                'use_as_base_fieldset' => false
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}