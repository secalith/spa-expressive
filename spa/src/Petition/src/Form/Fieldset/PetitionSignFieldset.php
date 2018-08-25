<?php

declare(strict_types=1);

namespace Petition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Petition\Model\PetitionSignatureModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class PetitionSignFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new PetitionSignatureModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => _("Name and Surname")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("(required)"),
            ],
        ));
        $this->add(array(
            'type' => 'email',
            'name' => 'email',
            'options' => array(
                'label' => _("Email")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("(required)"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'privacy',
            'options' => array(
                'label' => _("Email")
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'newsletter',
            'options' => array(
                'label' => 'I’d like to hear about news from #stopACTA2',
                'label_attributes' => array(
                    'class'  => 'form-check-label ml-3',
                    'for' => 'register-newsletter',
                ),
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
            ),
            'attributes' => [
                'class' => 'form-check-input d-inline-flex w-auto',
                'id' => 'register-newsletter',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'terms',
            'options' => array(
                'label' => 'I agree to the terms of service and privacy policy.',
                'label_attributes' => array(
                    'class'  => 'form-check-label ml-3',
                    'for' => 'register-terms',
                ),
                'use_hidden_element' => false,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => [
                'class' => 'form-check-input d-inline-flex w-auto',
                'id' => 'register-terms',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            ),
            'email' => array(
                'required' => true,
            ),
            'newsletter' => array(
                'required' => false,
            ),
            'terms' => array(
                'required' => true,
            ),
        );
    }

}