<?php
namespace SpaPetition\Form;

use SpaPetition\Model\SignatureModel;
use Zend\InputFilter\InputFilter;
use Zend\Form\Form as Form;

class SignatureForm extends Form
{
    public function __construct()
    {
        parent::__construct('signatire');

        $this
            ->setAttribute('method', 'post')
            ->setObject(new SignatureModel())
        ;

        $this->addElements();

    }

    protected function addElements()
    {

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'application_id',
        ], ['priority'=>0]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name_first',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'First Name',
            ],
            'options' => [
                'label' => "First Name",
            ],
        ], ['priority'=>40]);

        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name_last',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "Last Name",
            ],
            'options' => [
                'label' => "Last Name",
            ],
        ], ['priority'=>30]);

        $this->add([
            'type' => 'Zend\Form\Element\Email',
            'name' => 'contact_email',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => "Email",
            ],
            'options' => [
                'label' => "Email",
            ],
        ], ['priority'=>30]);

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ], ['priority'=>60]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Place Request',
                'class' => 'btn btn-warning btn-lg w-100',
            ],
        ], ['priority'=>-100]);
    }
}
