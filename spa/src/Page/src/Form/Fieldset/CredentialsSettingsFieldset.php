<?php

declare(strict_types=1);

namespace User\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use User\Model\UserCredentialsModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class CredentialsSettingsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new UserCredentialsModel());

        $this->addElements();
    }

    protected function addElements()
    {
        $this->add(array(
            'type' => 'hidden',
            'name' => 'uid'
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'confirmation',
            'options' => [
                'label' => 'Users` Password',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'value_options' => [
                    '0' => 'Set password now',
                    '1' => 'Send email to primary',
                    '2' => 'Send email to custom',
                ],
            ],
            'attributes' => [
                'class' => 'form-control toggle-aware-trigger',
                'data-toggle' => '{"0":{"show":["element_credentials_settings_manual"]},"1":{"show":["element_credentials_settings_primary"]},"2":{"show":["element_credentials_settings_other"]}}',
                'onChange' => 'javascript:spaForm.toggleFieldset($(this));return false;',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return array(
            'confirmation' => array(
                'required' => true,
            ),
        );
    }

}