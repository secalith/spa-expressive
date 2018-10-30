<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PetitionModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Button',
            'name' => 'remove_element',
            'options' => [
                'label' => 'Remove Element',
            ],
            'attributes' => [
                'id' => 'remove-element',
                'class' => 'btn btn-sm btn-xs btn-danger float-right d-none',
                'onClick' => 'javascript:formCreate.remove($(this),"element");reindexAllElementsAttributeName($(this));return false;',
            ],
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status_i18n',
            'options' => [
                'label' => 'Status Tlumaczenia Petycji',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'value_options' => [
                    '0' => _("Wylaczone"),
                    '1' => _("Opublikowane"),
                ],
            ],
            'attributes' => [
                'class' => 'form-control toggle-aware-trigger',
            ],
        ]);
        $this->add(array(
            'name' => 'fieldset_petition_data_title',
            'type' => PetitionDataTitleFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_petition_data_text',
            'type' => PetitionDataTextFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'status_i18n' => array(
                'required' => true,
            ),
        );
    }

}