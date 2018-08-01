<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Page\Model\WriteFieldsetModel;
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
            'name' => 'fieldset_page',
            'type' => \Page\Form\Fieldset\PageFieldset::class,
            'options' => array(
                'label' => _("Strona"),
                'use_as_base_fieldset' => false
            )
        ));

        $this->add(array(
            'name' => 'fieldset_route',
            'type' => \PageRoute\Form\Fieldset\RouteFieldset::class,
            'options' => array(
                'label' => _("Route"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_router',
            'type' => \PageRoute\Form\Fieldset\RouterFieldset::class,
            'options' => array(
                'label' => _("Router"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_template',
            'type' => \PageTemplate\Form\Fieldset\TemplateFieldset::class,
            'options' => array(
                'label' => _("Szablon"),
                'use_as_base_fieldset' => false
            )
        ));




    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}