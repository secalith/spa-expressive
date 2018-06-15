<?php
namespace SinglePageApplication\Content\Form\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class UpdateForm extends Form
{
    
    public function __construct($name='singlepageapplication_content_update', $options = [])
    {
        parent::__construct($name,$options);

        $this->setAttribute('class', 'form-horizontal')
            //->setHydrator($h)
            ->setInputFilter(new InputFilter());
        $this->setAttribute('method', 'post');


        $this->add(array(
            'type' => 'SinglePageApplication\Content\Form\Fieldset\UpdateFoundationFieldset',
            'name' => 'singlepageapplication_content_update',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->setValidationGroup([
            'singlepageapplication_content_update',
        ]);
    }
}