<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \User\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class WriteFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new WriteFieldsetModel());
//        $this->setInputFilter($this->addInputFilter())

        $this->addElements();
    }

    protected function addElements()
    {

        $this->add(array(
            'name' => 'fieldset_user',
            'type' => \User\Form\Fieldset\UserFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));

        $this->add(array(
            'name' => 'fieldset_user_profile',
            'type' => \User\Form\Fieldset\UserProfileFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_email_alias',
            'type' => \User\Form\Fieldset\EmailAliasFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_credentials',
            'type' => \User\Form\Fieldset\CredentialsFieldset::class,
            'options' => array(
                'use_as_base_fieldset' => false
            )
        ));


//        $this->add(array(
//            'name' => 'fieldset_status',
//            'type' => \RestableAdmin\Client\Form\Fieldset\StatusFieldset::class,
//        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
//            'client_name' => array(
//                'required' => true,
//            ),
        );
    }

}