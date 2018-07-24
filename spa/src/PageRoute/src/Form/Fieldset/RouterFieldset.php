<?php

declare(strict_types=1);

namespace PageRoute\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use PageRoute\Model\RouterEntryModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class RouterFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new RouterEntryModel());
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
                'value' => 'router-' . time(),
            ],
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parent_uid',
            'options' => array(
                'label' => _("Nadrzedny Router"),
                'value_options' => [
                    '0' => _("Brak"),
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'application_uid',
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'route_uid',
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'site_uid',
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'route_url',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'scenario',
            'options' => array(
                'label' => _("Tryb Routera"),
                'value_options' => [
                    'display' => _("Wyswietl"),
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'controller',
            'options' => array(
                'label' => _("Kontroler"),
                'value_options' => [
                    '\Page\Handler\PageHandler' => _("\Page\Handler\PageHandler"),
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
                'label' => _("Status Routera"),
                'value_options' => [
                    '0' => _("Wylaczony"),
                    '1' => _("Aktywny"),

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
            'parent_uid' => array(
                'required' => true,
            ),
            'scenario' => array(
                'required' => true,
            ),
            'controller' => array(
                'required' => true,
            ),
        );
    }

}