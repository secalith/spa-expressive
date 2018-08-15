<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use User\Model\UserProfileModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class RegisterUserProfileFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new UserProfileModel());
//        $this->setInputFilter($this->addInputFilter())

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
            'name' => 'name_first',
            'options' => array(
                'label' => _("What's Your First Name?"),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name_last',
            'options' => array(
                'label' => _("What's Your Last Name?"),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'organization',
            'options' => array(
                'label' => _("What’s your company / organization called?"),
            ),
            'attributes' => [
                'class' => 'form-control d-block',
            ],
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'name_first' => array(
                'required' => true,
            ),
            'name_last' => array(
                'required' => true,
            ),
            'organization' => array(
                'required' => false,
            ),
        );
    }

}