<?php

declare(strict_types=1);

namespace Content\Form\Fieldset;

use Zend\InputFilter\InputFilterProviderInterface;
use Content\Model\ContentModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class ContentFieldset extends Fieldset implements InputFilterProviderInterface
{

    private $event_groups;

    public function __construct($name = null, $options = array(), $event_groups=[])
    {
        parent::__construct($name,$options);

        $this->setHydrator(new ClassMethods(true));
        $this->setObject(new ContentModel());

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
            'type' => 'text',
            'name' => 'parent_uid',
            'options' => array(
                'label' => _("Parent")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("0"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'block_uid',
            'options' => array(
                'label' => _("Block")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("block-100-production"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'template_uid',
            'options' => array(
                'label' => _("Template")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("template-001"),
            ],
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'type',
            'options' => array(
                'label' => _("Type")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("content"),
            ],
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'content',
            'options' => array(
                'label' => _("Content")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("Lorem ipsum..."),
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

        $this->add(array(
            'type' => 'textarea',
            'name' => 'order',
            'options' => array(
                'label' => _("Order")
            ),
            'attributes' => [
                'class' => 'form-control d-block',
                'placeholder' => _("1"),
            ],
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'uid' => array(
                'required' => true,
            ),
            'name' => array(
                'required' => true,
            ),
            'country' => array(
                'required' => true,
            ),
            'application_uid' => array(
                'required' => true,
            ),
            'site_uid' => array(
                'required' => true,
            ),
            'event_group' => array(
                'required' => true,
            ),
            'status' => array(
                'required' => true,
            ),
        );
    }

    public function get_eu_countries() {
        $countries = [];
        $countries['en_en'] = 'Global';
        $countries['AT'] = 'Austria';
        $countries['BE'] = 'Belgium';
        $countries['BG'] = 'Bulgaria';
        $countries['CY'] = 'Cyprus';
        $countries['CZ'] = 'Czech Republic';
        $countries['DE'] = 'Germany';
        $countries['DK'] = 'Denmark';
        $countries['EE'] = 'Estonia';
        $countries['ES'] = 'Spain';
        $countries['FI'] = 'Finland';
        $countries['FR'] = 'France';
        $countries['GB'] = 'United Kingdom';
        $countries['GR'] = 'Greece';
        $countries['HU'] = 'Hungary';
        $countries['HR'] = 'Croatia';
        $countries['IE'] = 'Ireland, Republic of (EIRE)';
        $countries['IT'] = 'Italy';
        $countries['LT'] = 'Lithuania';
        $countries['LU'] = 'Luxembourg';
        $countries['LV'] = 'Latvia';
        $countries['MT'] = 'Malta';
        $countries['NL'] = 'Netherlands';
        $countries['PL'] = 'Poland';
        $countries['PT'] = 'Portugal';
        $countries['RO'] = 'Romania';
        $countries['SE'] = 'Sweden';
        $countries['SI'] = 'Slovenia';
        $countries['SK'] = 'Slovakia';

        return $countries;
    }

}