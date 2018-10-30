<?php

declare(strict_types=1);

namespace Site\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Site\Model\SiteModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class SiteFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new SiteModel());

        $this->event_groups = $event_groups;

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
            'options' => array(
                'label' => _("UID")
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
                'value' => microtime(),
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'site_name',
            'options' => array(
                'label' => _("Name")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'application_uid',
            'options' => array(
                'label' => _("Application"),
                'value_options' => [
                    'spa' => 'SPA',
                    'meme' => 'Meme Machine',
                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'comment',
            'options' => array(
                'label' => _("Comment"),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => _("Status"),
                'value_options' => [
                    '0' => _("Hidden"),
                    '1' => _("Visible"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => false,
            ),
            'site_name' => array(
                'required' => true,
            ),
            'application_uid' => array(
                'required' => true,
            ),
            'comment' => array(
                'required' => false,
            ),
            'status' => array(
                'required' => true,
            ),
        );
    }

}