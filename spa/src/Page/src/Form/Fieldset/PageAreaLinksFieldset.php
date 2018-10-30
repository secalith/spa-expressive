<?php

declare(strict_types=1);

namespace Page\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Page\Model\PageModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PageAreaLinksFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
//        $this->setObject(new PageModel());
        $this->setAttribute('class','page_type_links-collection');

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'page_layout',
            'options' => array(
                'label' => _("Page Layout"),
                'value_options' => [
                    'link' => _("Link"),

                ],
            ),
            'attributes' => [
                'class' => 'form-control d-inline-flex w-auto',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}