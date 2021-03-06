<?php

declare(strict_types=1);

namespace Petition\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use \Petition\Model\WriteFieldsetModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class PetitionWriteFieldset extends Fieldset implements InputFilterProviderInterface
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
            'name' => 'fieldset_petition',
            'type' => \Petition\Form\Fieldset\PetitionFieldset::class,
            'options' => array(
                'label' => _("Petition"),
                'use_as_base_fieldset' => false
            )
        ));
        $this->add(array(
            'name' => 'fieldset_petition_translation',
            'type' => \Petition\Form\Fieldset\PetitionTranslationFieldset::class,
            'options' => array(
                'label' => _("Petition Translation"),
                'use_as_base_fieldset' => false
            )
        ));
        /*
         *
         $this->add(array(
            'name' => 'fieldset_petition_translation',
            'type' => \Zend\Form\Element\Collection::class,
            'options' => array(
                'label' => _("Petition Translation"),
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => \Petition\Form\Fieldset\PetitionTranslationFieldset::class,
                ),
            )
        ));

         */
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}