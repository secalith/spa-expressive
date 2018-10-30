<?php

declare(strict_types=1);

namespace RestableAdmin\Client\Form\Fieldset;

use RestableAdmin\Client\Model\StatusModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;

class StatusFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new StatusModel());

        $this->addElements($options);


    }

    protected function addElements($options=[])
    {
        if( ! array_key_exists('status_code_value',$options))
        {
            $curr = $this->getObject()->getStatusCurrentWithLabel(StatusModel::STOCK_STATUS_DEFAULT);
            $status_code_options = $this->getObject()->getStatusAvailableWithLabels();

        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status_code',
            'options' => array(
                'label' => 'Client Status',
                'value_options' => [
                    'current' => [
                        'label' => 'Current',
                        'options' => $curr,
                    ],
                    'available' => [
                        'label' => 'Available',
                        'options' => $status_code_options
                    ],
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));


    }

    public function getInputFilterSpecification()
    {
        return array(
            'status_code' => array(
                'required' => true,
            ),
        );
    }

}