<?php

declare(strict_types=1);

namespace SpaPetition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use SpaPetition\Model\PetitionModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PetitionDataFieldset extends Fieldset implements InputFilterProviderInterface
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
            'type' => 'Zend\Form\Element\Select',
            'name' => 'default_language',
            'options' => [
                'label' => _("Jezyk podstawowy"),
                'label_attributes' => [
                    'class' => 'control-label',
                ],
//                'empty_option' => _("[ Wybierz ]"),
                'value_options' => [
                    'pl_pl' => _("Polski"),
                    'en_gb' => _("Angielski (Brytyjski)"),
                ],
            ],
            'attributes' => [
                'class' => 'form-control toggle-aware-trigger',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'title',
            'options' => [
                'label' => 'Nazwa wewnetrzna',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => [
                'label' => 'Status Petycji',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => _("[ Wybierz ]"),
                'value_options' => [
                    '0' => _("Wylaczona"),
                    '1' => _("Opublikowana"),
                ],
            ],
            'attributes' => [
                'class' => 'form-control toggle-aware-trigger',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'status' => array(
                'required' => true,
            ),
        );
    }

}