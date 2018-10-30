<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Page\Model\PageModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageAreaPetitionAreasFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PageModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'area_main',
            'options' => array(
                'label' => _("Area Main"),
                'value_options' => [
                    'petition' => _("Petition"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'area_form',
            'options' => array(
                'label' => _("Area Form"),
                'value_options' => [
                    'support' => _("Support"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}