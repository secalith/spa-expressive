<?php

declare(strict_types=1);

namespace Auth\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Auth\Model\CodeModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class CodeFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new CodeModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'code',
            'options' => [
                'label' => 'Reset Code',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Code'
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'code' => array(
                'required' => true,
            ),
        );
    }

}