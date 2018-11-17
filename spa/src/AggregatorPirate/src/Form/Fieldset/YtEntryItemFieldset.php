<?php

declare(strict_types=1);

namespace AggregatorPirate\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use AggregatorPirate\Model\YtEntryItemModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;


class YtEntryItemFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new YtEntryItemModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'status',
            'attributes' => [
                'value' => '1',
            ],
        ));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'parent_uid',
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'yt_id',
            'options' => array(
                'label' => _("Youtube ID")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => '',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => _("Title")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => '',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'comm',
            'options' => array(
                'label' => _("Internal Comment")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => '',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => true,
                'continue_if_empty' => true,
            ),
            'status' => array(
                'required' => true,
            ),
            'parent_uid' => array(
                'required' => true,
            ),
            'yt_id' => array(
                'required' => true,
            ),
            'title' => array(
                'required' => true,
            ),
            'comm' => array(
                'required' => false,
            ),
        );
    }

}