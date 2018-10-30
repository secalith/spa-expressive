<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Page\Model\PageModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageAreaFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PageModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'page_type_event',
            'type' => \Page\Form\Fieldset\PageAreaEventFieldset::class,
            'options' => array(
                'label' => _("Area"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'page_type_petition',
            'type' => \Page\Form\Fieldset\PageAreaPetitionFieldset::class,
            'options' => array(
                'label' => _("Petition"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'page_type_links',
            'type' => \Page\Form\Fieldset\PageAreaLinksFieldset::class,
            'options' => array(
                'label' => _("Links"),
                'use_as_base_fieldset' => false
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}