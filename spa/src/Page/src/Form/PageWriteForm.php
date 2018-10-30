<?php

declare(strict_types=1);

namespace Page\Form;

use \Page\Model\PageCreateModel;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageWriteForm extends Form
{
    private $petitions;

    public function __construct($name = 'form_create', $options = array(),$petitions=null)
    {
        parent::__construct($name,$options);

        $this
            ->setAttribute('method', 'post')
            ->setObject(new PageCreateModel())
            ->setHydrator(new ClassMethods(true))
//            ->setInputFilter($this->addInputFilter())
        ;

        $this->petitions = $petitions;

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
            'name' => 'form_create',
            'type' => \Page\Form\Fieldset\WriteFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        // apply petitions
        $this->get('form_create')
            ->get('fieldset_area')
            ->get('page_type_petition')
            ->get('page_type_petition_areas')
            ->get('area_main')
            ->setValueOptions($this->petitions)
        ;

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ], ['priority'=>60]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Submit',
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
