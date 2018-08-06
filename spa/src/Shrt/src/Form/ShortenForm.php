<?php

declare(strict_types=1);

namespace Shrt\Form;

use \Shrt\Model\ShortenModel;
use Zend\Form\Form as Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ShortenForm extends Form
{
    public function __construct($name = 'form_create', $options = array())
    {
        parent::__construct($name,$options);

        $this
            ->setAttribute('method', 'post')
            ->setObject(new ShortenModel())
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
            'name' => 'application_uid',
        ], ['priority'=>10]);

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'site_uid',
        ], ['priority'=>20]);

        $this->add(array(
            'name' => 'form_create',
            'type' => \Shrt\Form\Fieldset\ShortenFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => true
            ),
            'attributes' => [
                'class' => 'd-block'
            ],
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ], ['priority'=>60]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => _('Continue'),
                'class' => 'btn btn-success d-block w-100 ',
            ],
        ], ['priority'=>-100]);
    }

    private function addInputFilter()
    {

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'application_uid',
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

        $inputFilter->add([
            'name'     => 'site_uid',
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
