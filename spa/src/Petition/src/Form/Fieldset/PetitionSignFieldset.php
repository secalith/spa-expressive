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
            'type' => 'text',
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
        );
    }

}