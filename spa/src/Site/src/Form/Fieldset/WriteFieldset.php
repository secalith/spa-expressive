<?php

declare(strict_types=1);

namespace Site\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Site\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class WriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_site',
            'type' => \Site\Form\Fieldset\SiteFieldset::class,
            'options' => array(
                'label' => _("Application"),
                'use_as_base_fieldset' => false
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}