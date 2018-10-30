<?php

declare(strict_types=1);

namespace Shrt\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Shrt\Model\LinkModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class LinkFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new LinkModel());

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'link_url',
            'options' => array(
                'label' => _("Url"),
            ),
            'attributes' => [
                'class' => 'form-control d-block w-100',
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}