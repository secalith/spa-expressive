<?php

declare(strict_types=1);

namespace User\Form;

use \User\Model\DeleteUserModel;
use Zend\Form\Form as Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class UserDeleteForm extends Form
{
    public function __construct($name = 'form_delete', $options = array())
    {
        parent::__construct($name,$options);

        $this
            ->setAttribute('method', 'post')
            ->setObject(new DeleteUserModel())
            ->setHydrator(new ClassMethods(true))
            ->setInputFilter($this->addInputFilter())
        ;

        $this->addElements($options);

        $this->addInputFilter();

    }

    protected function addElements($options=null)
    {

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'application_id',
        ], ['priority'=>10]);

        $this->add(array(
            'name' => 'form_delete',
            'type' => \User\Form\Fieldset\RemoveFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ], ['priority'=>60]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Remove',
                'class' => 'btn btn-success ',
            ],
        ], ['priority'=>-100]);
    }

    private function addInputFilter()
    {

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'application_id',
            'required' => false,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 64,
                        'encoding' => 'UTF-8',
                    ],
                ],
            ],
        ]);

        return $inputFilter;
    }
}
