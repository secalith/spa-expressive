<?php

declare(strict_types=1);

namespace PageTemplate\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use PageTemplate\Model\PageTemplateModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class TemplateFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new PageTemplateModel());
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
                'value' => time(),
            ],
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'route_uid',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'name',
            'options' => array(
                'label' => _("Name"),
                'value_options' => [
                    'page-petitions-spa' => _("page-petitions-spa"),
                    'page-standard-spa' => _("page-standard-spa"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'label' => _("Typ"),
                'value_options' => [
                    'filesystem' => _("Plik"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'location',
            'options' => array(
                'label' => _("Lokacja"),
                'value_options' => [
                    'page-view' => _("page-view"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'label',
            'options' => array(
                'label' => _("Etykieta")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => time(),
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
            'type' => array(
                'required' => true,
            ),
            'location' => array(
                'required' => true,
            ),
            'label' => array(
                'required' => false,
            ),
            'status' => array(
                'required' => false,
            ),
        );
    }

}